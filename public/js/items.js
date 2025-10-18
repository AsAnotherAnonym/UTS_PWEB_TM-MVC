function deleteItem(id) {
    if (confirm('Apakah Anda yakin ingin menghapus item ini?')) {
        ajaxRequest(
            BASE_URL + '/items/delete',
            { id: id },
            function(response) {
                if (response.success) {
                    showNotification('Item berhasil dihapus!', 'success');
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                } else {
                    showNotification('Gagal menghapus item!', 'error');
                }
            },
            function(xhr, status, error) {
                showNotification('Terjadi kesalahan: ' + error, 'error');
            }
        );
    }
}

$(document).ready(function() {
    
    $('form[action*="items"]').on('submit', function(e) {
        const name = $('input[name="name"]').val().trim();
        const price = $('input[name="price"]').val();
        
        if (name === '') {
            e.preventDefault();
            alert('Nama item tidak boleh kosong!');
            $('input[name="name"]').focus();
            return false;
        }
        
        if (price <= 0) {
            e.preventDefault();
            alert('Harga harus lebih dari 0!');
            $('input[name="price"]').focus();
            return false;
        }
    });
    
    $('input[name="price"]').on('input', function() {
        let value = $(this).val().replace(/\D/g, '');
        if (value) {
            const formatted = 'Rp ' + parseInt(value).toLocaleString('id-ID');
            $(this).next('.price-preview').remove();
            $(this).after(`<small class="text-muted price-preview d-block mt-1">${formatted}</small>`);
        }
    });
    
});