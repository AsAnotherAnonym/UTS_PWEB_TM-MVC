const BASE_URL = window.location.origin + '/webdemo_mvc';

$(document).ready(function() {
    
    if ($('#dataTable').length) {
        $('#dataTable').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
            },
            pageLength: 10,
            responsive: true,
            order: [[0, 'desc']]
        });
    }
    
    if ($('.alert').length) {
        setTimeout(function() {
            $('.alert').fadeOut('slow');
        }, 5000);
    }
    
    $('a[href*="logout"]').on('click', function(e) {
        if (!confirm('Apakah Anda yakin ingin logout?')) {
            e.preventDefault();
        }
    });

    $('input[name="price"]').on('keyup', function() {
        let value = $(this).val().replace(/\D/g, '');
        $(this).val(value);
    });
    
});

function ajaxRequest(url, data, successCallback, errorCallback) {
    $.ajax({
        url: url,
        method: 'POST',
        data: data,
        dataType: 'json',
        success: function(response) {
            if (successCallback) successCallback(response);
        },
        error: function(xhr, status, error) {
            if (errorCallback) {
                errorCallback(xhr, status, error);
            } else {
                alert('Terjadi kesalahan: ' + error);
            }
        }
    });
}

function showNotification(message, type = 'success') {
    const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
    const alertHtml = `
        <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    `;
    
    $('.container').first().prepend(alertHtml);
    
    setTimeout(function() {
        $('.alert').fadeOut('slow', function() {
            $(this).remove();
        });
    }, 3000);
}