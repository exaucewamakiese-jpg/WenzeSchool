<?php
// Classe de base : opérations CRUD tenantées et requêtes préparées.
abstract class Entity {
    protected PDO $db;
    protected string $table;
    protected array $fields;
    protected array $required = [];

    // Reçoit la connexion et les règles de la classe concrète.
    public function __construct(PDO $db) { $this->db = $db; }

    // Liste uniquement les enregistrements de l'établissement connecté.
    public function all(int $schoolId): array {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE school_id = ? ORDER BY id DESC LIMIT 500");
        $stmt->execute([$schoolId]);
        return $stmt->fetchAll();
    }

    // Enregistre ou met à jour une fiche, avec validation des champs autorisés.
    public function save(int $schoolId, array $data, ?int $id = null): array {
        $values = [];
        foreach ($this->fields as $field) {
            if (array_key_exists($field, $data)) $values[$field] = is_string($data[$field]) ? trim($data[$field]) : $data[$field];
        }
        foreach ($this->required as $field) {
            if (!isset($values[$field]) || $values[$field] === '') throw new InvalidArgumentException("Le champ {$field} est obligatoire.");
        }
        if (!$values) throw new InvalidArgumentException('Aucune donnée valide à enregistrer.');
        if ($id) {
            $sets = implode(', ', array_map(fn($field) => "{$field} = :{$field}", array_keys($values)));
            $values['id'] = $id; $values['school_id'] = $schoolId;
            $stmt = $this->db->prepare("UPDATE {$this->table} SET {$sets}, updated_at = NOW() WHERE id = :id AND school_id = :school_id");
            $stmt->execute($values);
            if (!$stmt->rowCount()) {
                $check = $this->db->prepare("SELECT id FROM {$this->table} WHERE id = ? AND school_id = ?");
                $check->execute([$id, $schoolId]);
                if (!$check->fetch()) throw new RuntimeException('Fiche introuvable dans cet établissement.');
            }
            return ['id' => $id] + $values;
        }
        $offlineKey = $values['offline_key'] ?? null;
        if ($offlineKey) {
            $find = $this->db->prepare("SELECT id FROM {$this->table} WHERE school_id = ? AND offline_key = ?");
            $find->execute([$schoolId, $offlineKey]);
            $existing = $find->fetchColumn();
            if ($existing) return ['id' => (int)$existing, 'offline_key' => $offlineKey];
        }
        $values['school_id'] = $schoolId;
        $columns = array_keys($values);
        $sql = "INSERT INTO {$this->table} (" . implode(',', $columns) . ") VALUES (" . implode(',', array_map(fn($key) => ':' . $key, $columns)) . ")";
        $stmt = $this->db->prepare($sql); $stmt->execute($values);
        return ['id' => (int)$this->db->lastInsertId()] + $values;
    }

    // Supprime une fiche seulement si elle appartient à l'établissement connecté.
    public function delete(int $schoolId, int $id): void {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = ? AND school_id = ?");
        $stmt->execute([$id, $schoolId]);
    }

    // Recherche l'identifiant serveur correspondant à une clé créée hors ligne.
    public function findByOfflineKey(int $schoolId, string $key): ?int {
        $stmt = $this->db->prepare("SELECT id FROM {$this->table} WHERE school_id = ? AND offline_key = ?");
        $stmt->execute([$schoolId, $key]); $id = $stmt->fetchColumn();
        return $id ? (int)$id : null;
    }
}
