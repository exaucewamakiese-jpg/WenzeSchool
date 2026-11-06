<?php
// Chaque classe représente une table métier et déclare ses champs modifiables.
class Student extends Entity { protected string $table = 'students'; protected array $fields = ['first_name','last_name','birth_date','gender','class_name','phone','address','offline_key']; protected array $required = ['first_name','last_name']; }
class Teacher extends Entity { protected string $table = 'teachers'; protected array $fields = ['first_name','last_name','subject','phone','email','offline_key']; protected array $required = ['first_name','last_name']; }
class SchoolClass extends Entity { protected string $table = 'classes'; protected array $fields = ['name','level','school_year','room','offline_key']; protected array $required = ['name']; }
class ParentRecord extends Entity { protected string $table = 'parents'; protected array $fields = ['first_name','last_name','phone','email','address','student_name','offline_key']; protected array $required = ['first_name','last_name']; }
class Course extends Entity { protected string $table = 'courses'; protected array $fields = ['title','class_name','teacher_name','coefficient','offline_key']; protected array $required = ['title']; }
class Payment extends Entity { protected string $table = 'payments'; protected array $fields = ['student_name','amount','currency','payment_type','paid_on','reference','offline_key']; protected array $required = ['student_name','amount']; }
class Grade extends Entity { protected string $table = 'grades'; protected array $fields = ['student_name','course_name','term','score','max_score','coefficient','offline_key']; protected array $required = ['student_name','course_name','score']; }
class Publication extends Entity { protected string $table = 'publications'; protected array $fields = ['title','body','published_on','offline_key']; protected array $required = ['title']; }
class Enrollment extends Entity { protected string $table = 'enrollments'; protected array $fields = ['student_name','class_name','school_year','enrollment_type','enrolled_on','offline_key']; protected array $required = ['student_name','class_name']; }
