<?php
include("php/config.php");

if (isset($_GET['id'])) {
    $course_id = intval($_GET['id']);
    $query = "DELETE FROM courses WHERE id=$course_id";
    if (mysqli_query($con, $query)) {
        header("Location: home.php");
    } else {
        echo "Erro ao excluir o curso: " . mysqli_error($con);
    }
}
?>