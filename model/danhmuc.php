<?php


function LoadAll_DM()
{
  $sql = "SELECT * FROM danhmuc ";
  $dm = pdo_query($sql);
  return $dm;
}

function xoadm($id)
{
  $sql = " DELETE FROM danhmuc  WHERE id_dm = $id";
  pdo_query($sql);
}

function add_dm($name)
{
  $sql = "INSERT INTO danhmuc(name_dm) VALUES ('$name')";
  pdo_execute($sql);
}

function load_one_dm($id)
{
  $sql = "SELECT * FROM danhmuc where id_dm = $id";
  $dm = pdo_query_one($sql);
  return $dm;
}
function upload_dm($id, $name)
{
  $sql = "UPDATE danhmuc SET name_dm='$name' WHERE id_dm='$id'";
  pdo_query($sql);
}

function thongke()
{
  $sql = "SELECT danhmuc.id_dm, name_dm, COUNT(sanpham.id_sp) AS Tong
  FROM danhmuc
  LEFT JOIN sanpham ON sanpham.id_dm = danhmuc.id_dm
  GROUP BY danhmuc.id_dm, name_dm;";
  $dm = pdo_query($sql);
  return $dm;
}
