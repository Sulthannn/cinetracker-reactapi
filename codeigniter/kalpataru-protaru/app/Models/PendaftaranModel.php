<?php

namespace App\Models;

use CodeIgniter\Model;

class PendaftaranModel extends Model
{
    // Default tabel yang digunakan
    protected $table = 'pendaftaran';
    protected $primaryKey = 'id_pendaftaran';
    protected $allowedFields = [
        'id_pendaftaran',
        'id_pengusul',
        'id_tim_teknis',
        'kategori',
        'tanggal_pendaftaran',
        'status_pendaftaran',
        'catatan_verifikasi',
        'skor_sidang_1',
        'skor_sidang_2',
        'nama',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'usia',
        'jenis_kelamin',
        'jalan',
        'rt_rw',
        'desa',
        'kecamatan',
        'kab_kota',
        'provinsi',
        'kode_pos',
        'pekerjaan',
        'telepon',
        'email',
        'sosial_media',
        'pendidikan',
        'ktp',
        'skck',
        'nama_kelompok',
        'nama_ketua',
        'jumlah_anggota',
        'tahun_pembentukan',
        'legalitas',
        'edit',
        'kode_registrasi',
        'status_dokumen',
        'skor_dokumen',
        'tanggal_skck',
        'tanggal_legalitas'
    ];

    public function simpanCalonIdentitas()
    {
        $Model = new PendaftaranModel();

        // Ambil data pendaftaran dari session
        $pendaftaranData = session()->get('pendaftaran_data');

        if (!$pendaftaranData || !isset($pendaftaranData['kategori'])) {
            return redirect()->back()->with('error', 'Data kategori atau pendaftaran tidak ditemukan.');
        }

        // Validasi file upload untuk KTP (JPG/JPEG) dan SKCK (PDF)
        $validationRule = [
            'ktp' => [
                'uploaded[ktp]',
                'mime_in[ktp,image/jpg,image/jpeg]',
                'max_size[ktp,1024]',
            ],
            'skck' => [
                'uploaded[skck]',
                'mime_in[skck,application/pdf]',
                'max_size[skck,1024]',
            ]
        ];

        if (!$this->validate($validationRule)) {
            return redirect()->back()->withInput()->with('error', 'Validasi file gagal. Pastikan format dan ukuran file benar.');
        }

        $legalitasFile = $this->request->getFile('legalitas');
        if ($legalitasFile->isValid() && !$legalitasFile->hasMoved()) {
            if ($legalitasFile->getExtension() === 'pdf' && $legalitasFile->getSize() <= 1024 * 1024) {
                $originalName = pathinfo($legalitasFile->getClientName(), PATHINFO_FILENAME);
                $extension = $legalitasFile->getExtension();
                $legalitasFileName = $originalName . '_' . bin2hex(random_bytes(5)) . '.' . $extension;
                $legalitasFile->store('legalitas', $legalitasFileName);
            } else {
                return redirect()->back()->with('error', 'File harus berupa PDF dan ukuran maksimal 1MB.');
            }
        }


        $ktpFile = $this->request->getFile('ktp');
        if ($ktpFile->isValid() && !$ktpFile->hasMoved()) {
            $allowedExtensions = ['jpg', 'jpeg'];
            if (in_array($ktpFile->getExtension(), $allowedExtensions) && $ktpFile->getSize() <= 1024 * 1024) {
                // Ambil nama asli file tanpa ekstensi
                $originalName = pathinfo($ktpFile->getClientName(), PATHINFO_FILENAME);
                // Dapatkan ekstensi file
                $extension = $ktpFile->getExtension();
                // Buat nama file baru dengan format "originalName_randomString.extension"
                $ktpFileName = $originalName . '_' . bin2hex(random_bytes(5)) . '.' . $extension;
                // Simpan file dengan nama yang baru
                $ktpFile->store('ktp', $ktpFileName);
            } else {
                // Tampilkan pesan kesalahan jika bukan JPG/JPEG atau melebihi 1MB
                return redirect()->back()->with('error', 'File harus berupa JPG atau JPEG dan ukuran maksimal 1MB.');
            }
        }


        $skckFile = $this->request->getFile('skck');
        if ($skckFile->isValid() && !$skckFile->hasMoved()) {
            if ($skckFile->getExtension() === 'pdf' && $skckFile->getSize() <= 1024 * 1024) {
                $originalName = pathinfo($skckFile->getClientName(), PATHINFO_FILENAME);
                $extension = $skckFile->getExtension();
                $skckFileName = $originalName . '_' . bin2hex(random_bytes(5)) . '.' . $extension;
                $skckFile->store('skck', $skckFileName);
            } else {
                return redirect()->back()->with('error', 'File harus berupa PDF dan ukuran maksimal 1MB.');
            }
        }

        // Simpan data lainnya tergantung kategori
        if ($pendaftaranData['kategori'] == 'Penyelamat Lingkungan') {
            $data = [
                'nama' => $this->request->getPost('nama_ketua'),
                'tahun_pembentukan' => $this->request->getPost('tahun_pembentukan'),
                'jumlah_anggota' => $this->request->getPost('jumlah_anggota'),
                'jalan' => $this->request->getPost('jalan'),
                'rt_rw' => $this->request->getPost('rt_rw'),
                'desa' => $this->request->getPost('desa'),
                'kecamatan' => $this->request->getPost('kecamatan'),
                'kab_kota' => $this->request->getPost('kab_kota'),
                'provinsi' => $this->request->getPost('provinsi'),
                'kode_pos' => $this->request->getPost('kode_pos'),
                'sosial_media' => $this->request->getPost('media_sosial'),
                'nama_kelompok' => $this->request->getPost('nama_kelompok'),
                'nik' => $this->request->getPost('nik'),
                'tempat_lahir' => $this->request->getPost('tempat_lahir'),
                'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
                'usia' => $this->request->getPost('usia'),
                'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
                'pekerjaan' => $this->request->getPost('pekerjaan'),
                'telepon' => $this->request->getPost('telepon'),
                'email' => $this->request->getPost('email'),
                'pendidikan' => $this->request->getPost('pendidikan'),
                'tanggal_skck' => $this->request->getPost('tanggal_skck'),
                'tanggal_legalitas' => $this->request->getPost('tanggal_legalitas'),
                'legalitas' => $legalitasFileName,
                'ktp' => $ktpFileName,
                'skck' => $skckFileName
            ];
        } else {
            $data = [
                'nama' => $this->request->getPost('nama_individu'),
                'nik' => $this->request->getPost('nik_individu'),
                'tempat_lahir' => $this->request->getPost('tempat_lahir'),
                'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
                'usia' => $this->request->getPost('usia'),
                'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
                'pekerjaan' => $this->request->getPost('pekerjaan'),
                'telepon' => $this->request->getPost('telepon'),
                'email' => $this->request->getPost('email'),
                'pendidikan' => $this->request->getPost('pendidikan'),
                'jalan' => $this->request->getPost('jalan'),
                'rt_rw' => $this->request->getPost('rt_rw'),
                'desa' => $this->request->getPost('desa'),
                'kecamatan' => $this->request->getPost('kecamatan'),
                'kab_kota' => $this->request->getPost('kab_kota'),
                'provinsi' => $this->request->getPost('provinsi'),
                'kode_pos' => $this->request->getPost('kode_pos'),
                'sosial_media' => $this->request->getPost('media_sosial'),
                'tanggal_skck' => $this->request->getPost('tanggal_skck'),
                'ktp' => $ktpFileName,
                'skck' => $skckFileName
            ];
        }

        // Gabungkan data identitas dengan data pendaftaran sebelumnya dari session
        $finalData = array_merge($pendaftaranData, $data);

        // Simpan data ke database
        if ($Model->insert($finalData)) {
            // Hapus session setelah data disimpan
            session()->remove('pendaftaran_data');

            return redirect()->to('pengusul/usulansaya')->with('success', 'Identitas berhasil disimpan.');
        } else {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }

    public function getDetailById($id)
    {
        // Mengambil detail pendaftaran
        $pendaftaran = $this->select('
                pendaftaran.*,
                dampak.id_dampak AS dampak_id,
                dampak.*, 
                pmik.id_pmik AS pmik_id, 
                pmik.*, 
                keswadayaan.id_keswadayaan AS keswadayaan_id, 
                keswadayaan.*, 
                keistimewaan.id_keistimewaan AS keistimewaan_id,
                keistimewaan.*
            ')
            ->join('dampak', 'dampak.id_pendaftaran = pendaftaran.id_pendaftaran', 'left')
            ->join('pmik', 'pmik.id_pendaftaran = pendaftaran.id_pendaftaran', 'left')
            ->join('keswadayaan', 'keswadayaan.id_pendaftaran = pendaftaran.id_pendaftaran', 'left')
            ->join('keistimewaan', 'keistimewaan.id_pendaftaran = pendaftaran.id_pendaftaran', 'left')
            ->where('pendaftaran.id_pendaftaran', $id)
            ->first();

        // Mengambil kegiatan berdasarkan id_pendaftaran
        $pendaftaran['kegiatan'] = $this->getKegiatanByPendaftaranId($id);

        return $pendaftaran;
    }

    // -------------------------------------------------------------------------

    public function getPendaftaranById($id)
    {
        return $this->find($id);
    }

    // ------------------IDENTITAS------------------
    public function insertIdentitas($data)
    {
        return $this->db->table('pendaftaran')->insert($data);
    }

    public function getIdentitasByIdPendaftaran($id_pendaftaran)
    {
        return $this->db->table('pendaftaran')->where('id_pendaftaran', $id_pendaftaran)->get()->getRowArray();
    }

    public function updateIdentitas($data, $where)
    {
        return $this->db->table('pendaftaran')->where($where)->update($data);
    }

    // ------------------KEGIATAN------------------
    public function insertKegiatan($data)
    {
        return $this->db->table('kegiatan')->insert($data);
    }

    public function getKegiatanByPendaftaranId($id)
    {
        return $this->db->table('kegiatan') // Ganti dengan nama tabel yang sesuai
            ->where('id_pendaftaran', $id) // Ganti dengan kolom yang sesuai
            ->get()
            ->getResultArray(); // Sesuaikan dengan cara Anda mengambil data
    }

    public function getKegiatanByTipe($id, $tipe)
    {
        return $this->db->table('kegiatan')
            ->where('id_pendaftaran', $id)
            ->where('tipe_kegiatan', $tipe)
            ->get()
            ->getResultArray();
    }


    public function updateKegiatan($data, $where)
    {
        return $this->db->table('kegiatan')->where($where)->update($data);
    }

    // ------------------DAMPAK------------------
    public function insertDampak($data)
    {
        return $this->db->table('dampak')->insert($data);
    }

    public function getDampakByIdPendaftaran($id_pendaftaran)
    {
        return $this->db->table('dampak')->where('id_pendaftaran', $id_pendaftaran)->get()->getRowArray();
    }

    public function updateDampak($data, $where)
    {
        return $this->db->table('dampak')->where($where)->update($data);
    }

    // ------------------PMIK------------------
    public function insertPMIK($data)
    {
        return $this->db->table('pmik')->insert($data);
    }

    public function getPMIKByIdPendaftaran($id_pendaftaran)
    {
        return $this->db->table('pmik')->where('id_pendaftaran', $id_pendaftaran)->get()->getRowArray();
    }

    public function updatePMIK($data, $where)
    {
        return $this->db->table('pmik')->where($where)->update($data);
    }

    // ------------------KESWADAYAAN------------------
    public function insertKeswadayaan($data)
    {
        return $this->db->table('keswadayaan')->insert($data);
    }

    public function getKeswadayaanByIdPendaftaran($id_pendaftaran)
    {
        return $this->db->table('keswadayaan')->where('id_pendaftaran', $id_pendaftaran)->get()->getRowArray();
    }

    public function updateKeswadayaan($data, $where)
    {
        return $this->db->table('keswadayaan')->where($where)->update($data);
    }

    // ------------------KEISTIMEWAAN------------------
    public function insertKeistimewaan($data)
    {
        return $this->db->table('keistimewaan')->insert($data);
    }

    public function getKeistimewaanByIdPendaftaran($id_pendaftaran)
    {
        return $this->db->table('keistimewaan')->where('id_pendaftaran', $id_pendaftaran)->get()->getRowArray();
    }

    public function updateKeistimewaan($data, $where)
    {
        return $this->db->table('keistimewaan')->where($where)->update($data);
    }


    // -------------------------------------------------------------------------


    // Method untuk mendapatkan data pendaftaran berdasarkan ID pengusul
    public function getPendaftaranByPengusul($id_pengusul)
    {
        return $this->where('id_pengusul', $id_pengusul)->findAll();
    }

    // Method untuk mendapatkan data pendaftaran berdasarkan status
    public function getPendaftaranByStatus($status_pendaftaran)
    {
        return $this->where('status_pendaftaran', $status_pendaftaran)->findAll();
    }

    // Method untuk membuat pendaftaran baru
    public function createPendaftaran($data)
    {
        return $this->insert($data);
    }

    // Method untuk memperbarui pendaftaran berdasarkan ID
    public function updatePendaftaran($id_pendaftaran, $data)
    {
        return $this->update($id_pendaftaran, $data);
    }

    // Method untuk menghapus pendaftaran berdasarkan ID
    public function deletePendaftaran($id_pendaftaran)
    {
        return $this->delete($id_pendaftaran);
    }



    // Ambil semua kegiatan berdasarkan id_pendaftaran
    public function getAllKegiatanByPendaftaranId($id_pendaftaran)
    {
        return $this->db->table('kegiatan')
            ->where('id_pendaftaran', $id_pendaftaran)
            ->get()
            ->getResultArray();
    }


    public function updateStatusAndEdit($id_pendaftaran)
    {
        $data = [
            'status_pendaftaran' => 'Terkirim', // Update status menjadi Terkirim
            'edit' => 'Off' // Update kolom edit menjadi Off
        ];

        // Update record berdasarkan id_pendaftaran
        return $this->db->table('pendaftaran')
            ->where('id_pendaftaran', $id_pendaftaran)
            ->update($this->table, $data);
    }

    public function getDataCalonNonDraft()
    {
        // Mengambil semua data calon kecuali yang berstatus 'Draft'
        return $this->where('status_pendaftaran !=', 'Draft')
            ->findAll();
    }
}
