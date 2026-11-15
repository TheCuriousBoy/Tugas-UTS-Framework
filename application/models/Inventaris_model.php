<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventaris_model extends CI_Model
{
    public function getAllInventaris($keyword = null, $kategori = null)
    {
        if ($keyword) {
            $kw = $this->db->escape_str($keyword);
            $kat_sql = "";
            if ($kategori) {
                $kat = $this->db->escape_str($kategori);
                $kat_sql = " AND `kategori` = '$kat' ";
            }
            $sql = "SELECT * FROM `inventaris_it`
                    WHERE (`kode_barang` LIKE '%$kw%'
                       OR `nama_barang` LIKE '%$kw%'
                       OR `lokasi` LIKE '%$kw%'
                       OR `spesifikasi` LIKE '%$kw%')
                    $kat_sql
                    ORDER BY `id` DESC";
            return $this->db->query($sql)->result_array();
        }

        if ($kategori) {
            $this->db->where('kategori', $kategori);
        }
        $this->db->order_by('id', 'DESC');
        return $this->db->get('inventaris_it')->result_array();
    }

    public function getInventarisById($id)
    {
        return $this->db->get_where('inventaris_it', ['id' => $id])->row_array();
    }

    public function getSummaryStats()
    {
        $all = $this->db->get('inventaris_it')->result_array();
        $total_jenis = count($all);
        $total_unit = 0;
        $baik = 0;
        $perbaikan = 0;
        $rusak = 0;

        foreach ($all as $row) {
            $jml = (int)$row['jumlah'];
            $total_unit += $jml;
            if ($row['kondisi'] === 'Baik') {
                $baik += $jml;
            } elseif ($row['kondisi'] === 'Perlu Perbaikan') {
                $perbaikan += $jml;
            } else {
                $rusak += $jml;
            }
        }

        return [
            'total_jenis' => $total_jenis,
            'total_unit'  => $total_unit,
            'baik'        => $baik,
            'perbaikan'   => $perbaikan,
            'rusak'       => $rusak
        ];
    }
}
