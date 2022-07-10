<?php

/**
 * Get the article record based on the ID
 *
 * @param object $conn Connection to the database.
 * @param integer $id the article ID
 * @param string $columns 欄位
 * @return mixed An associative array containing the article with that ID, or null if not found
 */
function getArticle($conn, $id, $columns = '*')
{
    $sql = "SELECT $columns
            FROM article
            WHERE id =?";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false) {
        echo mysqli_error($conn);
    } else {
        mysqli_stmt_bind_param($stmt, "i", $id);

        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            return mysqli_fetch_array($result, MYSQLI_ASSOC);
        }
    }
}

/**
 * 驗證文章屬性
 *
 * @param string $title 標題
 * @param string $content 內容
 * @param string $published_at 時間
 * @return array 錯誤訊息陣列
 */
function validateArticle($title, $content, $published_at)
{
    $errors = [];

    if (empty($title)) {
        $errors[] = 'Title is required';
    }

    if (empty($content)) {
        $errors[] = 'Content is required';
    }

    if (!empty($published_at)) {
        $date_time = date_create_from_format('Y-m-d H:i:s', $published_at);

        if ($date_time === false) {
            $errors[] = 'Invalid date and time';
        } else {
            $date_errors = date_get_last_errors();

            if ($date_errors['warning_count'] > 0) {
                $errors[] = 'Invalid date and time';
            }
        }
    }

    return $errors;
}
