let inventory = [];
let editingId = null;

// DOM Elements
const tableBody = document.getElementById('tableBody');
const form = document.getElementById('inventoryForm');
const kodeBarangInput = document.getElementById('kodeBarang');
const namaProdukInput = document.getElementById('namaProduk');
const kategoriSelect = document.getElementById('kategori');
const stokInput = document.getElementById('stok');
const hargaInput = document.getElementById('harga');
const tanggalMasukInput = document.getElementById('tanggalMasuk');
const fotoProdukInput = document.getElementById('fotoProduk');
const previewImg = document.getElementById('previewImg');
const submitBtn = document.getElementById('submitBtn');
const cancelBtn = document.getElementById('cancelBtn');
const formTitle = document.getElementById('formTitle');
const filterCategory = document.getElementById('filterCategory');
const searchInput = document.getElementById('searchInput');

// Statistik
const totalItemsEl = document.getElementById('totalItems');
const totalInventoryValueEl = document.getElementById('totalInventoryValue');
const lowStockCountEl = document.getElementById('lowStockCount');

// Jam digital
const jamDigitalSpan = document.getElementById('jamDigital');

// ============================================
// FUNGSI BANTU
// ============================================
const formatRupiah = (angka) => {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    }).format(angka);
};

const saveToLocalStorage = () => {
    localStorage.setItem('inventory', JSON.stringify(inventory));
};

const fileToBase64 = (file) => {
    return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => resolve(reader.result);
        reader.onerror = error => reject(error);
    });
};

// Preview foto
fotoProdukInput.addEventListener('change', (e) => {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = (event) => {
            previewImg.src = event.target.result;
            previewImg.style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        previewImg.style.display = 'none';
        previewImg.src = '';
    }
});

// Load data dari localStorage
const loadFromLocalStorage = () => {
    const stored = localStorage.getItem('inventory');
    if (stored) {
        inventory = JSON.parse(stored);
    } else {
        inventory = [
            {
                kode: 'F001',
                nama: 'Red Race Suit',
                kategori: 'Race Wear',
                stok: 5,
                harga: 3000000,
                tanggalMasuk: '2025-01-10',
                gambar: ''
            },
            {
                kode: 'F002',
                nama: "Leclerc's Helmet",
                kategori: 'Race Wear',
                stok: 2,
                harga: 10000000,
                tanggalMasuk: '2025-01-15',
                gambar: ''
            },
            {
                kode: 'F003',
                nama: 'Red Jacket',
                kategori: 'Daily Wear',
                stok: 0,
                harga: 700000,
                tanggalMasuk: '2025-02-01',
                gambar: ''
            },
            {
                kode: 'F004',
                nama: 'Shanghai Edition',
                kategori: 'Daily Wear',
                stok: 8,
                harga: 900000,
                tanggalMasuk: '2025-02-10',
                gambar: ''
            },
            {
                kode: 'F005',
                nama: 'SF-24 Diecast 1:18',
                kategori: 'Diecast & Model',
                stok: 3,
                harga: 1250000,
                tanggalMasuk: '2025-03-01',
                gambar: ''
            }
        ];
        saveToLocalStorage();
    }
};

// Validasi Form
const validateForm = () => {
    let isValid = true;
    document.querySelectorAll('.error-message').forEach(el => el.textContent = '');
    
    const kode = kodeBarangInput.value.trim();
    if (!kode) {
        document.getElementById('errorKode').textContent = 'Kode barang wajib diisi';
        isValid = false;
    } else if (kode.length < 3) {
        document.getElementById('errorKode').textContent = 'Minimal 3 karakter';
        isValid = false;
    } else {
        const isDuplicate = inventory.some(item => item.kode === kode && (editingId !== kode));
        if (isDuplicate) {
            document.getElementById('errorKode').textContent = 'Kode barang sudah ada';
            isValid = false;
        }
    }
    
    if (!namaProdukInput.value.trim()) {
        document.getElementById('errorNama').textContent = 'Nama produk wajib diisi';
        isValid = false;
    }
    if (!kategoriSelect.value) {
        document.getElementById('errorKategori').textContent = 'Pilih kategori';
        isValid = false;
    }
    const stok = parseInt(stokInput.value);
    if (isNaN(stok) || stok < 0) {
        document.getElementById('errorStok').textContent = 'Stok harus angka >= 0';
        isValid = false;
    }
    const harga = parseInt(hargaInput.value);
    if (isNaN(harga) || harga <= 0) {
        document.getElementById('errorHarga').textContent = 'Harga harus angka > 0';
        isValid = false;
    }
    if (!tanggalMasukInput.value) {
        document.getElementById('errorTanggal').textContent = 'Tanggal masuk wajib diisi';
        isValid = false;
    }
    return isValid;
};

const resetForm = () => {
    form.reset();
    editingId = null;
    submitBtn.textContent = 'Simpan Barang';
    formTitle.textContent = 'Tambah Barang Baru';
    previewImg.style.display = 'none';
    previewImg.src = '';
    fotoProdukInput.value = '';
    document.querySelectorAll('.error-message').forEach(el => el.textContent = '');
};

// Helper gambar
const getImageSrc = (item) => {
    if (item.gambar && item.gambar.startsWith('data:image')) {
        return item.gambar;
    }
    // fallback ke gambar statis berdasarkan nama (untuk produk default)
    const mapping = {
        'Red Race Suit': 'Images/RACE-SUIT-Salin.jpg',
        "Leclerc's Helmet": 'Images/HELM.jpg',
        'Red Jacket': 'Images/JAKET-ORI.jpg',
        'Shanghai Edition': 'Images/SHANGHAI.jpg'
    };
    return mapping[item.nama] || 'https://placehold.co/200x200?text=No+Image';
};

// Render produk cards (SEMUA PRODUK)
const renderProdukCards = () => {
    const produkGrid = document.getElementById('produkGrid');
    if (!produkGrid) return;
    
    if (inventory.length === 0) {
        produkGrid.innerHTML = '<p style="color:white;">Belum ada produk</p>';
        return;
    }
    
    produkGrid.innerHTML = inventory.map(item => {
        const stokClass = item.stok <= 0 ? 'habis' : '';
        const stokText = item.stok <= 0 ? 'Stok Habis' : `Stok: ${item.stok}`;
        const imgSrc = getImageSrc(item);
        return `
            <div class="produk-card">
                <div class="produk-img">
                    <img src="${imgSrc}" alt="${item.nama}" onerror="this.src='https://placehold.co/200x200?text=No+Image'">
                </div>
                <div class="produk-info">
                    <p class="produk-kategori">${item.kategori}</p>
                    <h3 class="produk-nama">${item.nama}</h3>
                    <div class="produk-footer">
                        <span class="produk-harga">${formatRupiah(item.harga)}</span>
                        <span class="produk-stok ${stokClass}">${stokText}</span>
                    </div>
                </div>
            </div>
        `;
    }).join('');
};

// Update Statistik
const updateStats = () => {
    totalItemsEl.textContent = inventory.length;
    const totalValue = inventory.reduce((sum, item) => sum + (item.stok * item.harga), 0);
    totalInventoryValueEl.textContent = formatRupiah(totalValue);
    const lowStock = inventory.filter(item => item.stok < 5).length;
    lowStockCountEl.textContent = lowStock;
};

// Render Tabel
const renderTable = () => {
    const categoryFilter = filterCategory.value;
    const searchQuery = searchInput.value.toLowerCase();
    
    let filteredData = inventory.filter(item => {
        if (categoryFilter !== 'all' && item.kategori !== categoryFilter) return false;
        if (searchQuery) return item.nama.toLowerCase().includes(searchQuery) || item.kode.toLowerCase().includes(searchQuery);
        return true;
    });
    
    if (filteredData.length === 0) {
        tableBody.innerHTML = '<tr><td colspan="8" style="text-align: center;">Tidak ada data</td></tr>';
    } else {
        tableBody.innerHTML = filteredData.map(item => {
            const imgSrc = getImageSrc(item);
            return `
                <tr>
                    <td><img src="${imgSrc}" alt="${item.nama}" style="width:40px;height:40px;object-fit:cover;border-radius:4px;" onerror="this.src='https://placehold.co/40x40?text=No+Img'"></td>
                    <td>${item.kode}</td>
                    <td>${item.nama}</td>
                    <td>${item.kategori}</td>
                    <td>${item.stok}</td>
                    <td>${formatRupiah(item.harga)}</td>
                    <td>${item.tanggalMasuk}</td>
                    <td>
                        <button class="btn-edit" data-kode="${item.kode}">Edit</button>
                        <button class="btn-delete" data-kode="${item.kode}">Hapus</button>
                    </td>
                </tr>
            `;
        }).join('');
    }
    updateStats();
    renderProdukCards();
};

// Simpan barang
const saveInventoryItem = async (event) => {
    event.preventDefault();
    if (!validateForm()) return;
    
    let gambarBase64 = '';
    if (fotoProdukInput.files.length > 0) {
        gambarBase64 = await fileToBase64(fotoProdukInput.files[0]);
    } else if (editingId) {
        const existingItem = inventory.find(i => i.kode === editingId);
        if (existingItem && existingItem.gambar) {
            gambarBase64 = existingItem.gambar;
        }
    }
    
    const newItem = {
        kode: kodeBarangInput.value.trim(),
        nama: namaProdukInput.value.trim(),
        kategori: kategoriSelect.value,
        stok: parseInt(stokInput.value),
        harga: parseInt(hargaInput.value),
        tanggalMasuk: tanggalMasukInput.value,
        gambar: gambarBase64
    };
    
    if (editingId) {
        const index = inventory.findIndex(item => item.kode === editingId);
        if (index !== -1) inventory[index] = newItem;
        editingId = null;
    } else {
        inventory.push(newItem);
    }
    
    saveToLocalStorage();
    resetForm();
    renderTable();
};

// Edit
const editItem = (kode) => {
    const item = inventory.find(i => i.kode === kode);
    if (!item) return;
    editingId = kode;
    kodeBarangInput.value = item.kode;
    namaProdukInput.value = item.nama;
    kategoriSelect.value = item.kategori;
    stokInput.value = item.stok;
    hargaInput.value = item.harga;
    tanggalMasukInput.value = item.tanggalMasuk;
    if (item.gambar && item.gambar.startsWith('data:image')) {
        previewImg.src = item.gambar;
        previewImg.style.display = 'block';
    } else {
        previewImg.style.display = 'none';
    }
    submitBtn.textContent = 'Update Barang';
    formTitle.textContent = 'Edit Barang';
    document.querySelector('.form-card').scrollIntoView({ behavior: 'smooth' });
};

// Hapus
const deleteItem = (kode) => {
    if (confirm(`Hapus barang ${kode}?`)) {
        inventory = inventory.filter(item => item.kode !== kode);
        saveToLocalStorage();
        renderTable();
        if (editingId === kode) resetForm();
    }
};

// Event delegation tabel
const handleTableActions = (event) => {
    const target = event.target;
    if (target.classList.contains('btn-edit')) {
        editItem(target.getAttribute('data-kode'));
    } else if (target.classList.contains('btn-delete')) {
        deleteItem(target.getAttribute('data-kode'));
    }
};

const handleFilterAndSearch = () => renderTable();

// Jam digital real-time
const updateJamDigital = () => {
    const now = new Date();
    jamDigitalSpan.textContent = `${String(now.getHours()).padStart(2,'0')}:${String(now.getMinutes()).padStart(2,'0')}:${String(now.getSeconds()).padStart(2,'0')}`;
};

// INIT
const init = () => {
    loadFromLocalStorage();
    renderTable();
    form.addEventListener('submit', saveInventoryItem);
    cancelBtn.addEventListener('click', resetForm);
    tableBody.addEventListener('click', handleTableActions);
    filterCategory.addEventListener('change', handleFilterAndSearch);
    searchInput.addEventListener('input', handleFilterAndSearch);
    setInterval(updateJamDigital, 1000);
    updateJamDigital();
};

document.addEventListener('DOMContentLoaded', init);