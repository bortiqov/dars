<?php
include_once "dbconnection.php";

class coursedb
{
    private $data_base;
    public function __construct(){
        $this->data_base = dbconnection::getInstance()->getConnection();
    }
    public function select_all($fetch_type_index=2){
        $sql='SELECT course.id, course.keyword, subject.subject_name, cabinet.cabinet_name, concat(teacher.firstname," ",teacher.lastname) as fio, 
            course.status, course.start_date, course.duration, 
            (select count(*) from student_course where course_id=course.id) as students
            FROM course LEFT JOIN cabinet on course.cabinet_id = cabinet.id LEFT JOIN teacher on course.teacher_id = teacher.id 
            LEFT JOIN subject on course.subject_id = subject.id';
        $data=$this->data_base->prepare($sql);
        $data->execute();
        return $data->fetchAll($fetch_type_index);
    }
    public function delete_one($table, $id){
        $sql="DELETE FROM $table WHERE id=:id";
        $result=$this->data_base->prepare($sql);
        $result->bindParam(":id",$id);
        $result->execute();
        $error=$result->errorInfo();
        if ($error[0]==="00000"){
            return '<h3><label style="color: green">Malumotlar muvoffaqiyatli o`chirildi</label></h3>';
        }
        return '<h3><label style="color: red">Bu kursni o`chirib bo`lmaydi</label></h3>';
    }
    public function filter($column, $char, $value){
        $sql="SELECT course.id, course.keyword, subject.subject_name, cabinet.cabinet_name, concat(teacher.firstname,' ',teacher.lastname) as fio, 
            course.status, course.start_date, course.duration FROM course LEFT JOIN cabinet on course.cabinet_id = cabinet.id LEFT JOIN teacher on course.teacher_id = teacher.id 
            LEFT JOIN subject on course.subject_id = subject.id
            where $column $char :value";
        $data=$this->data_base->prepare($sql);
        $data->bindParam(':value',$value);
        $data->execute();
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }
    public function select_by_sql($sql,$fetch_type='fetchAll',$fetch_type_index=2){
        $data=$this->data_base->prepare($sql);
        $data->execute();
        return $data->$fetch_type($fetch_type_index);
    }
    public function insert($coursname,$subject_id,$teacher_id,$cabinet_id,$start_date,$duration,$status,$price,$lesson_time,$lengthtime){
        $select=$this->data_base->prepare('select * from course where keyword=:keyword');
        $select->bindParam(':keyword', $coursname);
        $select->execute();
        $count=$select->rowCount();
        if ($count==0) {

            $statment = $this->data_base->prepare("INSERT INTO course (keyword, subject_id, teacher_id, cabinet_id, start_date, duration, status, price)
VALUES (:keyword,:subject_id, :teacher_id, :cabinet_id, :start_date, :duration, :status, :price)");
            $statment->bindParam(':keyword', $coursname);
            $statment->bindParam(':subject_id', $subject_id);
            $statment->bindParam(':teacher_id', $teacher_id);
            $statment->bindParam(':cabinet_id', $cabinet_id);
            $statment->bindParam(':start_date', $start_date);
            $statment->bindParam(':duration', $duration);
            $statment->bindParam(':status', $status);
            $statment->bindParam(':price', $price);
            $statment->execute();
            $last_id=$this->data_base->lastInsertId();
            print_r($lesson_time);
            foreach ($lesson_time as $value){
                if (count($value)==2){
                    $statment_timetable=$this->data_base->prepare("INSERT INTO timetables (course_id, day_of_week, lesson_time, duration)
VALUES (:course_id,:day_of_week, :lesson_time, :duration)");
                    $day=$value['day'];
                    $time=$value['time'];
                    $statment_timetable->bindParam(':course_id',$last_id );
                    $statment_timetable->bindParam(':day_of_week', $day);
                    $statment_timetable->bindParam(':lesson_time', $time);
                    $statment_timetable->bindParam(':duration', $lengthtime);
                    $statment_timetable->execute();
                }
            }
                return '<h3><label style="color: green">'.$coursname.' kursi yaratildi </label></h3>';
    }

        else{
            return '<h3><label style="color: red">'.$coursname.' bu nomli kurs yaratilgan </label></h3>';
        }
    }
    public function select($column='*', $table, $condition='',$fetch_type_index=2){
        $sql="select $column from $table $condition";
        $statment=$this->data_base->query($sql);
        return $statment->fetchAll($fetch_type_index);
    }
    public function update($id_update,$coursname,$subject_id,$teacher_id,$cabinet_id,$start_date,$duration,$status,$price,$lesson_time,$lengthtime){
        $statment=$this->data_base->prepare("update course set keyword=:keyword,subject_id=:subject_id, teacher_id=:teacher_id, cabinet_id=:cabinet_id, start_date=:start_date, duration=:duration, status=:status, price=:price where id=:id");
        $statment->bindParam(':keyword',$coursname);
        $statment->bindParam(':subject_id',$subject_id);
        $statment->bindParam(':teacher_id',$teacher_id);
        $statment->bindParam(':cabinet_id',$cabinet_id);
        $statment->bindParam(':start_date',$start_date);
        $statment->bindParam(':duration',$duration);
        $statment->bindParam(':status',$status);
        $statment->bindParam(':price',$price);
        $statment->bindParam(':id',$id_update);
        $statment->execute();
        $statment_delete=$this->data_base->prepare("DELETE FROM timetables WHERE course_id=:id_update");
        $statment_delete->bindParam(':id_update',$id_update);
        $statment_delete->execute();

        foreach ($lesson_time as $value){
            if (count($value)==2){
                $statment_timetable=$this->data_base->prepare("INSERT INTO timetables (course_id, day_of_week, lesson_time, duration)
VALUES (:course_id,:day_of_week, :lesson_time, :duration)");
                $day=$value['day'];
                $time=$value['time'];
                $statment_timetable->bindParam(':course_id',$id_update );
                $statment_timetable->bindParam(':day_of_week', $day);
                $statment_timetable->bindParam(':lesson_time', $time);
                $statment_timetable->bindParam(':duration', $lengthtime);
                $statment_timetable->execute();
            }
        }
        return '<div id="page-wrapper">'.'<div id="page-inner">'.'<h2><label style="color: #4cae4c">Ma`lumotlar o`zgartirildi </label></h2>'."<a href='courses.php'><button class='btn btn-info'>Course list</button></a>".'</div>'.'</div>';
    }
}