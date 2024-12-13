<?php

namespace Service;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Export
{
    /**
     * Xuất danh sách bài viết ra file Excel.
     *
     * @param array $posts
     * @return void
     */
    public static function export_posts_to_excel($posts)
    {
        // Bắt đầu output buffering
        ob_start();
        // Tạo Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Thiết lập tiêu đề cột
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Category');
        $sheet->setCellValue('C1', 'Title');
        $sheet->setCellValue('D1', 'Content');
        $sheet->setCellValue('E1', 'Created At');
        $sheet->setCellValue('F1', 'Updated At');

        // Điền dữ liệu vào các hàng
        $row = 2; // Bắt đầu từ hàng thứ 2
        foreach ($posts as $post) {
            $sheet->setCellValue("A$row", $post->id);
            $sheet->setCellValue("B$row", $post->category->name);
            $sheet->setCellValue("C$row", $post->title);
            $sheet->setCellValue("D$row", $post->content);
            $sheet->setCellValue("E$row", $post->created_at);
            $sheet->setCellValue("F$row", $post->updated_at);
            $row++;
        }

        // Ghi dữ liệu vào file Excel
        $writer = new Xlsx($spreadsheet);

        // Thiết lập tên file và tải về
        $filename = 'posts_' . date('YmdHis') . '.xlsx';

        // Gửi header để tải file
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header('Cache-Control: max-age=0');

        $writer->save('php://output');

        // Kết thúc output buffering để tránh xuất bất kỳ nội dung nào sau khi xuất file
        ob_end_flush();
    }

    // Hàm để đọc file CSV và trả về dữ liệu dạng mảng
    public static function read_csv($file)
    {
        $data = [];
        if (($handle = fopen($file, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, ',')) !== false) {
                $data[] = $row;  // Mỗi dòng sẽ là một mảng
            }
            fclose($handle);
        }
        return $data;
    }

    // Hàm để import dữ liệu vào cơ sở dữ liệu
    public static function import_data($file)
    {
        // Đọc dữ liệu từ file CSV
        $data = self::read_csv($file);

        // Import vào DB (cập nhật theo model của bạn)
        foreach ($data as $row) {
            \Model_Post::forge([
                'field1' => $row[0],
                'field2' => $row[1],
                // Thêm các trường cần thiết của model
            ])->save();
        }
    }
}