$(document).ready(function(e) {
    initArea('area.cuaca-control');
    initMenu('.menu-cuaca-item a');
    renderCuaca('area.cuaca-control', dataCuaca);
    applyAttributes($('#jenis_pekerjaan_id'));

    $(document).on('change', 'select.resource-bill-of-quantity', function(e2){
        let select = $(this);
        setMinMaxVolume(select);
    })

    $(document).on('change', '#jenis_pekerjaan_id', function(e)
    {
        var s_jenis_pekerjaan_id = $(this).val();
        applyAttributes($('#jenis_pekerjaan_id'));
        $.ajax({
            'url':'lib.mobile-tools/ajax-load-peralatan-pekerjaan.php',
            'type':'GET',
            'dataType':'json',
            'data':{id:s_jenis_pekerjaan_id},
            success: function(data)
            {
                var i;
                var selector = $('select.resource-peralatan');
                selector.empty().append('<option value=""></option>');
                for(i in data)
                {
                    selector.append('<option value="'+data[i].v+'">'+data[i].l+'</option>');
                }
            }
        });
        $.ajax({
            'url':'lib.mobile-tools/ajax-load-material-pekerjaan.php',
            'type':'GET',
            'dataType':'json',
            'data':{id:s_jenis_pekerjaan_id},
            success: function(data)
            {
                var i;
                var selector = $('select.resource-material');
                selector.empty().append('<option value=""></option>');
                for(i in data)
                {
                    selector.append('<option value="'+data[i].v+'">'+data[i].l+'</option>');
                }
            }
        });
    });

    $(document).on('change', '#bill_of_quantity_id', function(e)
    {
        let select = $('.resource-bill-of-quantity');
        var s_bill_of_quantity_id = $(this).val();
        var proyek_id = $(this).find('option:selected').attr('data-proyek-id');
        $.ajax({
            'url':'lib.mobile-tools/ajax-load-bill-of-quantity.php',
            'type':'GET',
            'dataType':'html',
            'data':{proyek_id:proyek_id, parent_id:s_bill_of_quantity_id},
            success: function(data)
            {
                select.empty();
                select.append(data);
            }
        });
    });

    $(document).on('error', '#static-map-image', function(e){
        $(this).replaceWith('<div data-role="error">Tidak bisa menampilkan peta.</div>');
    });

    $(document).on('change', '#lokasi_proyek_id', function(e){
        detectLocation();
    });

    $(document).on('click', '.remover', function(e){
        var tr = $(this).closest('tr');
        if(confirm('Apakah Anda akan menghapus item ini?'))
        {
            tr.remove();
        }
    });

    $(document).on('click', '#tambah-peralatan', function(e){
        var id = 'rand_'+Math.round(Math.random()*100000);
        var res = $('.resource-peralatan')[0].outerHTML;
        var html = '<tr>\r\n'+
        '<td>'+res+'</td>\r\n'+
        '<td>\r\n'+
        '<input type="number" step="any" min="0" name="jumlah_'+id+'" value="1" class="form-control" required="required">\r\n'+
        '</td>\r\n'+
        '<td>\r\n'+
        '<button type="button" class="btn btn-danger remover">&#215;</button>\r\n'+
        '<input type="hidden" name="peralatan_proyek_id[]" value="'+id+'">\r\n'+
        '</td>\r\n'+
        '</tr>\r\n';
        var dom = $(html);
        dom.find('.resource-peralatan').attr({'name':'peralatan_id_'+id, 'required':'required'});
        $('#tabel-peralatan').append(dom);
    });

    $(document).on('click', '#tambah-material', function(e){
        var id = 'rand_'+Math.round(Math.random()*100000);
        var res = $('.resource-material')[0].outerHTML;
        var html = '<tr>\r\n'+
        '<td>'+res+'</td>\r\n'+
        '<td>\r\n'+
        '<input type="number" step="any" min="0" name="jumlah_'+id+'" value="1" class="form-control" required="required">\r\n'+
        '</td>\r\n'+
        '<td>\r\n'+
        '<button type="button" class="btn btn-danger remover">&#215;</button>\r\n'+
        '<input type="hidden" name="material_proyek_id[]" value="'+id+'">\r\n'+
        '</td>\r\n'+
        '</tr>\r\n';
        var dom = $(html);
        dom.find('.resource-material').attr({'name':'material_id_'+id, 'required':'required'});
        $('#tabel-material').append(dom);
    });

    $(document).on('click', '#tambah-boq', function(e){
        var id = 'rand_'+Math.round(Math.random()*100000);
        var res = $('.resource-bill-of-quantity')[0].outerHTML;
        var html = '<tr>\r\n'+
        '<td>'+res+'</td>\r\n'+
        '<td>\r\n'+
        '<input type="number" step="any" min="0" name="volume_'+id+'" value="" class="form-control volume" required="required">\r\n'+
        '</td>\r\n'+
        '<td>\r\n'+
        '<button type="button" class="btn btn-danger remover">&#215;</button>\r\n'+
        '<input type="hidden" name="boq_proyek_id[]" value="'+id+'">\r\n'+
        '</td>\r\n'+
        '</tr>\r\n';
        var dom = $(html);
        dom.find('.resource-bill-of-quantity').attr({'name':'boq_proyek_id_'+id, 'required':'required'});
        $('#tabel-boq').append(dom);
        setMinMaxVolume(dom.find('select'));
    });
});

var options = {
    enableHighAccuracy: true,
    timeout: 5000,
    maximumAge: 0
};

function setMinMaxVolume(select)
{
    let maxStr = select.find('option:selected').attr('data-volume');
    let minStr = select.find('option:selected').attr('data-volume-proyek');

    if(maxStr == '')
    {
        maxStr = '0';
    }
    if(minStr == '')
    {
        minStr = '0';
    }

    let maxVal = parseFloat(maxStr);
    let minVal = parseFloat(minStr);
    let volume = select.closest('tr').find('input.volume');
    volume.attr('min', minVal);
    volume.attr('max', maxVal);
}

function detectLocation()
{
    navigator.geolocation.getCurrentPosition(onSuccess, onError, options);
}

function onSuccess(position)
{
    $('[name="latitude"]').val(position.coords.latitude);
    $('[name="longitude"]').val(position.coords.longitude);
    $('[name="altitude"]').val(position.coords.altitude);
}

function onError(error)
{
    var errorMessage = "";
    switch(error.code) {
        case error.PERMISSION_DENIED:
            errorMessage = "Pengguna menolak permintaan geolokasi."
            break;
        case error.POSITION_UNAVAILABLE:
            errorMessage = "Geolokasi tidak tersedia."
            break;
        case error.TIMEOUT:
            errorMessage = "Tenggang waktu permintaan geolokasi telah habis."
            break;
        case error.UNKNOWN_ERROR:
            errorMessage = "Terjadi kesalahan yang tidak diketahui."
            break;
    }
    alert(errorMessage);
}

function applyAttributes(obj)
{
    var s_tipe_pondasi_id = obj.find('option:selected').attr('data-tipe-pondasi-id');
    var s_kelas_tower_id = obj.find('option:selected').attr('data-kelas-tower-id');
    var s_lokasi_proyek_id = obj.find('option:selected').attr('data-lokasi-proyek-id');
    var s_kegiatan = obj.find('option:selected').attr('data-kegiatan');

    if(s_tipe_pondasi_id == '0')
    {
        $('#tipe_pondasi_id').val('').removeAttr('required');
        $('#tipe_pondasi_id').closest('tr').css('display', 'none');
    }
    else
    {
        $('#tipe_pondasi_id').attr('required', 'required');
        $('#tipe_pondasi_id').closest('tr').css('display', 'table-row');
    }
    if(s_kelas_tower_id == '0')
    {
        $('#kelas_tower_id').val('').removeAttr('required');
        $('#kelas_tower_id').closest('tr').css('display', 'none');
    }
    else
    {
        $('#kelas_tower_id').attr('required', 'required');
        $('#kelas_tower_id').closest('tr').css('display', 'table-row');
    }
    if(s_lokasi_proyek_id == '0')
    {
        $('#lokasi_proyek_id').val('').removeAttr('required');
        $('#lokasi_proyek_id').closest('tr').css('display', 'none');
        $('#tambah-lokasi').closest('tr').css('display', 'none');
    }
    else
    {
        $('#lokasi_proyek_id').attr('required', 'required');
        $('#lokasi_proyek_id').closest('tr').css('display', 'table-row');
        $('#tambah-lokasi').closest('tr').css('display', 'table-row');
    }
    if(s_kegiatan == '0')
    {
        $('#kegiatan').val('').removeAttr('required');
        $('#kegiatan').closest('tr').css('display', 'none');
    }
    else
    {
        $('#kegiatan').attr('required', 'required');
        $('#kegiatan').closest('tr').css('display', 'table-row');
    }
}

function tambahLokasi()
{
    var nama = $('form[name="formlokasi_proyek"] [name="nama"]').val().trim();
    var kode_lokasi = $('form[name="formlokasi_proyek"] [name="kode_lokasi"]').val().trim();
    var proyek_id = $('form[name="formlokasi_proyek"] [name="proyek_id"]').val().trim();
    var latitude = $('form[name="formlokasi_proyek"] [name="latitude"]').val().trim();
    var longitude = $('form[name="formlokasi_proyek"] [name="longitude"]').val().trim();
    var atitude = $('form[name="formlokasi_proyek"] [name="atitude"]').val().trim();

    if(nama != '' && proyek_id != '')
    {
        $.ajax({
            url:'lib.mobile-tools/ajax-add-lokasi-proyek.php',
            type:'POST',
            dataType:"json",
            data:{action:'add', nama:nama, kode_lokasi:kode_lokasi, proyek_id:proyek_id, latitude:latitude, longitude:longitude, atitude:atitude},
            success: function(data){
                var obj = $('[name="formpekerjaan"] [name="lokasi_proyek_id"]');
                obj.empty();
                var i;
                for(i in data)
                {
                    obj.append('<option value="'+data[i].v+'">'+data[i].l+'</option>');
                }
                $('#addLocation').removeAttr('disabled');
                $('#add-location-modal').modal('hide')
            }
        });
    }
    return false;
}