<?php
include_once "UsefullMethods.php";

class QueryBuilder
{
    use UsefullMethods;

    private $db;

    protected function getAll($table)
    {
        $sql = "SELECT * FROM {$table}";
        $stmt = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $stmt;
    }

    protected function getOne($table, $id)
    {
        $sql = "SELECT * FROM {$table} WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_LAZY);
        return $result;
    }

    protected function create($table, $data)
    {
        // Arraydan oxirgi bo'sh qiymatli keyni olib tashlaymiz va faqat qiymati bor keylarni olamiz (bu button nomini olib tashlash uchun kerak).
        $keys = array_diff($data, array(''));
        // Tayyor array keylarini vergullar bilan ajratib string qilamiz, bu tablening ustunlari nomi bo'ladi.
        $columns = implode(', ', array_keys($keys));
        // Tayyorlangan keylarni arrayga o'tkazamiz.
        $keysForArray = explode(', ', $columns);
        // Arrayni for siklga solib har bir elementni oldidan ikki nuqta (:) o'rnatamiz va yangi arrayga yozamiz.
        $valueKeys = [];
        for ($i = 0; $i < count($keysForArray); $i++) {
            $valueKeys[] = ':' . $keysForArray[$i];
        }
        // Arraydan string o'tkazamiz.
        $values = implode(', ', $valueKeys);

        $sql = "INSERT INTO {$table} ({$columns}) VALUES ({$values})";
        $stmt = $this->db->prepare($sql);
        try {
            $stmt->execute($keys);
            $this->alertMessage("successfully", "Ma'lumotlar muvaffaqqiyatli qo'shildi!", "bg-success", "text-light", 10000);
            $this->goBack();
        }
        catch (Exception $e) {
            $this->alertMessage("failed", "Xatolik yuz berdi! <br>".$e->getMessage(), "bg-danger", "text-light", 10000);
            $this->goBack();
        }
    }
}