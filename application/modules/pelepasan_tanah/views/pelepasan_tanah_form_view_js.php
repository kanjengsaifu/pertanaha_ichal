<script type="text/javascript">
	
function surat_add() {
     
    $('#surat_modal').modal('show');
                $("#SuratModal").html('TAMBAH DATA SURAT');
                          $('#nama').val('');
                         $('#nik').val('');
                         $('#tempat_lahir').val('');
                         $('#pekerjaan').val('');
                         $('#tgl_lahir').val('');
                         $('#id').val('');
                         $('#alamat').val('');
  document.getElementById( "btn_simpan_surat" ).setAttribute( "onClick", "javascript: surat_simpan();" ); 
  $("#form_surat").attr('action','<?php echo $surat_add_url; ?>');
    
    

}


function surat_pelepasan_add() {
     
    $('#surat_pelepasan_modal').modal('show');
                $("#PelepsanModal").html('TAMBAH DATA SURAT');
                          $('#nama').val('');
                         $('#nik').val('');
                         $('#tempat_lahir').val('');
                         $('#pekerjaan').val('');
                         $('#tgl_lahir').val('');
                         $('#id').val('');
                         $('#alamat').val('');
  document.getElementById( "btn_simpan_surat_pelepasan" ).setAttribute( "onClick", "javascript: surat_pelepasan_simpan();" ); 
  $("#form_surat_pelepasan").attr('action','<?php echo $surat_pelepasan_add_url; ?>');
    
    

}


function surat_pelepasan_simpan(){

    $('#myPleaseWait').modal('show');
        
        $.ajax({
            url : $("#form_surat_pelepasan").attr('action'),
            data : $("#form_surat_pelepasan").serialize(),
            dataType : 'json',
            type : 'post',
            success : function(obj) {
                $('#myPleaseWait').modal('hide');
                 console.log(obj);
                if(obj.error==false){
                         
                         BootstrapDialog.alert({
                            type: BootstrapDialog.TYPE_PRIMARY,
                            title: 'Informasi',
                            message: obj.message,
                             
                        });   
                         
                        $("#surat_pelepasan_modal").modal('hide'); 
                        $('#surat').DataTable().ajax.reload();                       
                        $('#form_surat_pelepasan')[0].reset();
                        $('#pihak_pertama').val('');
                         $('#pihak_kedua').val('');
                         $('#tgl_surat_kec').val('');
                         $('#no_surat_kecamatan').val('');       
                         
                    }
                    else {
                         BootstrapDialog.alert({
                            type: BootstrapDialog.TYPE_DANGER,
                            title: 'Error',
                            message: obj.message ,
                             
                        }); 
                    }
            }
        });
        return false;
}
     

function surat_simpan(){

    $('#myPleaseWait').modal('show');
        
        $.ajax({
            url : $("#form_surat").attr('action'),
            data : $("#form_surat").serialize(),
            dataType : 'json',
            type : 'post',
            success : function(obj) {
                $('#myPleaseWait').modal('hide');
                 console.log(obj);
                if(obj.error==false){
                         
                         BootstrapDialog.alert({
                            type: BootstrapDialog.TYPE_PRIMARY,
                            title: 'Informasi',
                            message: obj.message,
                             
                        });   
                         
                        $("#surat_modal").modal('hide'); 
                        $('#surat').DataTable().ajax.reload();                       
                        $('#form_pemilik')[0].reset();
                        $('#nama_posisi').val('');
                         $('#nik_posisi').val('');
                         $('#tempat_lahir_posisi').val('');
                         $('#pekerjaan_posisi').val('');
                         $('#tgl_lahir_posisi').val('');
                         $('#jenis').val('');
                         $('#id_posisi').val('');
                         $('#alamat_posisi').val('');        
                         
                    }
                    else {
                         BootstrapDialog.alert({
                            type: BootstrapDialog.TYPE_DANGER,
                            title: 'Error',
                            message: obj.message ,
                             
                        }); 
                    }
            }
        });
        return false;
}

	$(document).ready(function() {

    
         $(".tanggal").datepicker().on('changeDate', function(ev){                 
             $('.tanggal').datepicker('hide');
        });

        $(".select2").select2();

     
     var dt = $("#surat").DataTable(
            {

                "columnDefs": [ { "targets": 0, "orderable": false } ],
                "processing": true,
                "serverSide": true,
                "ajax": '<?php echo $json_url_surat ?>'
            });


       


        $("#id_kota").change(function(){

    	$.ajax({

            url : '<?php echo site_url("$this->controller/get_kecamatan") ?>',
            data : { id_kota : $(this).val() },
            type : 'post', 
            success : function(result) {
                $("#id_kecamatan").html(result)
            }
      });

    });



   $("#id_kecamatan").change(function(){

    $.ajax({

            url : '<?php echo site_url("$this->controller/get_desa") ?>',
            data : { id_kecamatan : $(this).val() },
            type : 'post', 
            success : function(result) {
                $("#id_desa").html(result)
            }
      });

    });

$('#no_register_desa').focus(function(){
    console.log('test');

    $.ajax({
        url : '<?php echo site_url("$this->controller/get_no_regis") ?>',
        data :  $("#form_data").serialize(), 
        type : 'post',
        dataType : 'json',
        success : function(obj) {

            console.log(obj.error);

            if(obj.error == false) { // berhasil 

                // alert('hooooo.. error false');
                     console.log(obj.error);
            $("#no_register_desa").val(obj.no_registrasi_desa);
            $("#no_ket_desa").val(obj.no_ket_desa);
            $("#no_berita_acara_desa").val(obj.no_berita_acara_desa);
            
            }
            else {
                 BootstrapDialog.alert({
                            type: BootstrapDialog.TYPE_DANGER,
                            title: 'Error',
                            message: obj.message 
                             
                        });
                        // $("#rp_daftar_stnk").val(obj.rp_daftar_stnk);
            
            }

            
        }
    });
    return false;

});


   $("#tombolsubmitsimpan").click(function(){
 console.log('tests');

    $.ajax({
        url:'<?php echo site_url("$this->controller/simpan"); ?>',
        data : $('#form_data').serialize(),
        type : 'post',
        dataType : 'json',
        success : function(obj){

            console.log(obj.error);

            if(obj.error == false) { // berhasil 

                // alert('hooooo.. error false');
                     BootstrapDialog.alert({
                            type: BootstrapDialog.TYPE_PRIMARY,
                            title: 'Informasi',
                            message: obj.message,
                            
                            callback: function(result) {
                                                  location.href='<?php echo site_url("$this->controller"); ?>';
                            }
                             
                              });   
                          
                      // $('#form_data').data('bootstrapValidator').resetForm(true);
                      
            }
            else {
                 BootstrapDialog.alert({
                            type: BootstrapDialog.TYPE_DANGER,
                            title: 'Error',
                            message: obj.message 
                             
                        }); 
            }
        }
    });

    return false;
});

   $("#nik_posisi").blur(function(){
       // alert('hell yea..');

       $.ajax({
            url : '<?php echo site_url("$this->controller/get_data_penduduk") ?>',
           dataType : 'json',
            type : 'post',
            data : { nik_posisi : $("#nik_posisi").val()  },
            success : function(obj) {
                // console.log(obj);
               
                // alert(obj.nama_pemilik_tanah);
                // var type = [obj.Data.KodeDealer, obj.Data.NamaDealer];
                $('#nama_posisi').val(obj.nama_pemilik_tanah);
                $('#tempat_lahir_posisi').val(obj.tempat_lahir);
                $('#pekerjaan_posisi').val(obj.pekerjaan);
                $('#tgl_lahir_posisi').val(obj.tgl_lahir);
                
                
                $('#alamat_posisi').val(obj.alamat);

               

               
                // $.ajax({
                //     url : '<?php echo site_url("$this->controller/model") ?>',
                //     data : {Merk : obj.Data.Model},
                //     type : 'post', 
                //         success : function(result) {
                //         $("#id_model").html(result)
                //     }
                // });

                // $("#kode_dealer").val(obj.Data.KodeDealer);
                // alert(obj.Data.KodeDealer);


            }

       });


       
 });

   $("#nik").blur(function(){
       // alert('hell yea..');

       $.ajax({
            url : '<?php echo site_url("$this->controller/get_data_penduduk") ?>',
           dataType : 'json',
            type : 'post',
            data : { nik_posisi : $("#nik").val()  },
            success : function(obj) {
                // console.log(obj);
               
                // alert(obj.nama_pemilik_tanah);
                // var type = [obj.Data.KodeDealer, obj.Data.NamaDealer];
                $('#nama').val(obj.nama_pemilik_tanah);
                $('#tempat_lahir').val(obj.tempat_lahir);
                $('#pekerjaan').val(obj.pekerjaan);
                $('#tgl_lahir').val(obj.tgl_lahir);
                
                
                $('#alamat').val(obj.alamat);

               

               
                // $.ajax({
                //     url : '<?php echo site_url("$this->controller/model") ?>',
                //     data : {Merk : obj.Data.Model},
                //     type : 'post', 
                //         success : function(result) {
                //         $("#id_model").html(result)
                //     }
                // });

                // $("#kode_dealer").val(obj.Data.KodeDealer);
                // alert(obj.Data.KodeDealer);


            }

       });


       
 });



    $("#tombolsubmitupdate").click(function(){
 console.log('tests');

    $.ajax({
        url:'<?php echo site_url("$this->controller/update"); ?>',
        data : $('#form_data').serialize(),
        type : 'post',
        dataType : 'json',

        success : function(obj){

            console.log(obj.error);

            if(obj.error == false) { // berhasil 

                // alert('hooooo.. error false');
                     BootstrapDialog.alert({
                            type: BootstrapDialog.TYPE_PRIMARY,
                            title: 'Informasi',
                            message: obj.message,
                            
                            callback: function(result) {
                                                  location.href='<?php echo site_url("$this->controller"); ?>';
                            }
                             
                        });   
                      $('#form_data').data('bootstrapValidator').resetForm(true);
            }
            else {
                 BootstrapDialog.alert({
                            type: BootstrapDialog.TYPE_DANGER,
                            title: 'Error',
                            message: obj.message 
                             
                        }); 
            }
        }
    });

    return false;
});

});

function hapus_barat(id){



BootstrapDialog.show({
            message : 'ANDA AKAN MENGHAPUS DATA PEMILIK TANAH BAGIAN BARAT. ANDA YAKIN  ?  ',
            title: 'KONFIRMASI HAPUS DATA  PEMILIK TANAH BAGIAN BARAT',
            draggable: true,
            buttons : [
              {
                label : 'YA',
                cssClass : 'btn-primary',
                hotkey: 13,
                action : function(dialogItself){


                  dialogItself.close();
                  $('#myPleaseWait').modal('show'); 
                  $.ajax({
                    url : '<?php echo site_url("$this->controller/hapusdata_barat") ?>',
                    type : 'post',
                    data : {id : id},
                    dataType : 'json',
                    success : function(obj) {
                        $('#myPleaseWait').modal('hide'); 
                        if(obj.error==false) {
                                BootstrapDialog.alert({
                                      type: BootstrapDialog.TYPE_PRIMARY,
                                      title: 'Informasi',
                                      message: obj.message,
                                       
                                  });   

                            $('#posisi_barat').DataTable().ajax.reload();     
                        }
                        else {
                            BootstrapDialog.alert({
                                  type: BootstrapDialog.TYPE_DANGER,
                                  title: 'Error',
                                  message: obj.message,
                                   
                              }); 
                        }
                    }
                  });

                }
              },
              {
                label : 'TIDAK',
                cssClass : 'btn-danger',
                action: function(dialogItself){
                    dialogItself.close();
                }
              }
            ]
          });

}


function hapus_timur(id){



BootstrapDialog.show({
            message : 'ANDA AKAN MENGHAPUS DATA PEMILIK TANAH BAGIAN TIMUR. ANDA YAKIN  ?  ',
            title: 'KONFIRMASI HAPUS DATA  PEMILIK TANAH BAGIAN TIMUR',
            draggable: true,
            buttons : [
              {
                label : 'YA',
                cssClass : 'btn-primary',
                hotkey: 13,
                action : function(dialogItself){


                  dialogItself.close();
                  $('#myPleaseWait').modal('show'); 
                  $.ajax({
                    url : '<?php echo site_url("$this->controller/hapusdata_timur") ?>',
                    type : 'post',
                    data : {id : id},
                    dataType : 'json',
                    success : function(obj) {
                        $('#myPleaseWait').modal('hide'); 
                        if(obj.error==false) {
                                BootstrapDialog.alert({
                                      type: BootstrapDialog.TYPE_PRIMARY,
                                      title: 'Informasi',
                                      message: obj.message,
                                       
                                  });   

                            $('#posisi_timur').DataTable().ajax.reload();     
                        }
                        else {
                            BootstrapDialog.alert({
                                  type: BootstrapDialog.TYPE_DANGER,
                                  title: 'Error',
                                  message: obj.message,
                                   
                              }); 
                        }
                    }
                  });

                }
              },
              {
                label : 'TIDAK',
                cssClass : 'btn-danger',
                action: function(dialogItself){
                    dialogItself.close();
                }
              }
            ]
          });

}

function hapus_selatan(id){



BootstrapDialog.show({
            message : 'ANDA AKAN MENGHAPUS DATA PEMILIK TANAH BAGIAN SELATAN. ANDA YAKIN  ?  ',
            title: 'KONFIRMASI HAPUS DATA  PEMILIK TANAH BAGIAN SELATAN',
            draggable: true,
            buttons : [
              {
                label : 'YA',
                cssClass : 'btn-primary',
                hotkey: 13,
                action : function(dialogItself){


                  dialogItself.close();
                  $('#myPleaseWait').modal('show'); 
                  $.ajax({
                    url : '<?php echo site_url("$this->controller/hapusdata_selatan") ?>',
                    type : 'post',
                    data : {id : id},
                    dataType : 'json',
                    success : function(obj) {
                        $('#myPleaseWait').modal('hide'); 
                        if(obj.error==false) {
                                BootstrapDialog.alert({
                                      type: BootstrapDialog.TYPE_PRIMARY,
                                      title: 'Informasi',
                                      message: obj.message,
                                       
                                  });   

                            $('#posisi_selatan').DataTable().ajax.reload();     
                        }
                        else {
                            BootstrapDialog.alert({
                                  type: BootstrapDialog.TYPE_DANGER,
                                  title: 'Error',
                                  message: obj.message,
                                   
                              }); 
                        }
                    }
                  });

                }
              },
              {
                label : 'TIDAK',
                cssClass : 'btn-danger',
                action: function(dialogItself){
                    dialogItself.close();
                }
              }
            ]
          });

}

function hapus_utara(id){



BootstrapDialog.show({
            message : 'ANDA AKAN MENGHAPUS DATA PEMILIK TANAH BAGIAN UTARA. ANDA YAKIN  ?  ',
            title: 'KONFIRMASI HAPUS DATA  PEMILIK TANAH BAGIAN UTARA',
            draggable: true,
            buttons : [
              {
                label : 'YA',
                cssClass : 'btn-primary',
                hotkey: 13,
                action : function(dialogItself){


                  dialogItself.close();
                  $('#myPleaseWait').modal('show'); 
                  $.ajax({
                    url : '<?php echo site_url("$this->controller/hapusdata_utara") ?>',
                    type : 'post',
                    data : {id : id},
                    dataType : 'json',
                    success : function(obj) {
                        $('#myPleaseWait').modal('hide'); 
                        if(obj.error==false) {
                                BootstrapDialog.alert({
                                      type: BootstrapDialog.TYPE_PRIMARY,
                                      title: 'Informasi',
                                      message: obj.message,
                                       
                                  });   

                            $('#posisi_utara').DataTable().ajax.reload();     
                        }
                        else {
                            BootstrapDialog.alert({
                                  type: BootstrapDialog.TYPE_DANGER,
                                  title: 'Error',
                                  message: obj.message,
                                   
                              }); 
                        }
                    }
                  });

                }
              },
              {
                label : 'TIDAK',
                cssClass : 'btn-danger',
                action: function(dialogItself){
                    dialogItself.close();
                }
              }
            ]
          });

}



function hapus_saksi(id){



BootstrapDialog.show({
            message : 'ANDA AKAN MENGHAPUS DATA SAKSI. ANDA YAKIN  ?  ',
            title: 'KONFIRMASI HAPUS DATA SAKSI',
            draggable: true,
            buttons : [
              {
                label : 'YA',
                cssClass : 'btn-primary',
                hotkey: 13,
                action : function(dialogItself){


                  dialogItself.close();
                  $('#myPleaseWait').modal('show'); 
                  $.ajax({
                    url : '<?php echo site_url("$this->controller/hapusdata_saksi") ?>',
                    type : 'post',
                    data : {id : id},
                    dataType : 'json',
                    success : function(obj) {
                        $('#myPleaseWait').modal('hide'); 
                        if(obj.error==false) {
                                BootstrapDialog.alert({
                                      type: BootstrapDialog.TYPE_PRIMARY,
                                      title: 'Informasi',
                                      message: obj.message,
                                       
                                  });   

                            $('#saksi').DataTable().ajax.reload();     
                        }
                        else {
                            BootstrapDialog.alert({
                                  type: BootstrapDialog.TYPE_DANGER,
                                  title: 'Error',
                                  message: obj.message,
                                   
                              }); 
                        }
                    }
                  });

                }
              },
              {
                label : 'TIDAK',
                cssClass : 'btn-danger',
                action: function(dialogItself){
                    dialogItself.close();
                }
              }
            ]
          });

}



function hapus(id){



BootstrapDialog.show({
            message : 'ANDA AKAN MENGHAPUS DATA PEMILIK TANAH. ANDA YAKIN  ?  ',
            title: 'KONFIRMASI HAPUS DATA  PEMILIK TANAH',
            draggable: true,
            buttons : [
              {
                label : 'YA',
                cssClass : 'btn-primary',
                hotkey: 13,
                action : function(dialogItself){


                  dialogItself.close();
                  $('#myPleaseWait').modal('show'); 
                  $.ajax({
                    url : '<?php echo site_url("$this->controller/hapusdata_pemilik") ?>',
                    type : 'post',
                    data : {id : id},
                    dataType : 'json',
                    success : function(obj) {
                        $('#myPleaseWait').modal('hide'); 
                        if(obj.error==false) {
                                BootstrapDialog.alert({
                                      type: BootstrapDialog.TYPE_PRIMARY,
                                      title: 'Informasi',
                                      message: obj.message,
                                       
                                  });   

                            $('#pemilik').DataTable().ajax.reload();     
                        }
                        else {
                            BootstrapDialog.alert({
                                  type: BootstrapDialog.TYPE_DANGER,
                                  title: 'Error',
                                  message: obj.message,
                                   
                              }); 
                        }
                    }
                  });

                }
              },
              {
                label : 'TIDAK',
                cssClass : 'btn-danger',
                action: function(dialogItself){
                    dialogItself.close();
                }
              }
            ]
          });

}


function surat_edit(id){


    $('#surat_pelepasan_modal').modal('show');
    $("#form_surat").attr('action','<?php echo site_url("$this->controller/tmp_surat_update") ?>'); 


    $.ajax({
    url : '<?php echo site_url("$this->controller/get_surat_detail/"); ?>/'+id,
    dataType : 'json',
    success : function(jsonData) {
    $("#surat_pelepasan_modal").modal('show');
       $("#PelepasanModal").html('EDIT DATA SURAT');
       $(".tombol").prop('value','UPDATE DATA SURAT');

      $("#isi_surat").val(jsonData.surat);
      
      $("#id").val(jsonData.id);

      document.getElementById( "btn_simpan_surat_pelepasan" ).setAttribute( "onClick", "javascript: surat_update();" );
      
    }
  });
}


function saksi_edit(id){


    $('#saksi_modal').modal('show');
    $("#form_saksi").attr('action','<?php echo site_url("$this->controller/tmp_saksi_update") ?>'); 


    $.ajax({
    url : '<?php echo site_url("$this->controller/get_saksi_detail/"); ?>/'+id,
    dataType : 'json',
    success : function(jsonData) {
    $("#modal_saksi").modal('show');
       $("#SaksiModal").html('EDIT DATA SAKSI');
       $(".tombol").prop('value','UPDATE DATA SAKSI');
      $("#nama_posisi").val(jsonData.nama);
      $("#nik_posisi").val(jsonData.nik);
      $("#tempat_lahir_posisi").val(jsonData.tempat_lahir);
      $("#tgl_lahir_posisi").val(jsonData.tgl_lahir);
      $("#pekerjaan_posisi").val(jsonData.pekerjaan);
      $("#alamat_posisi").val(jsonData.alamat);
      $("#id_posisi").val(jsonData.id);

      document.getElementById( "btn_simpan_saksi" ).setAttribute( "onClick", "javascript: saksi_update();" );
      
    }
  });
}

function saksi_update(){
   $('#myPleaseWait').modal('show');
        
        $.ajax({
            url : '<?php echo site_url("$this->controller/saksi_update"); ?>',
            data : $("#form_saksi").serialize(),
            dataType : 'json',
            type : 'post',
            success : function(obj) {
                $('#myPleaseWait').modal('hide');
                 console.log(obj);
                if(obj.error==false){
                         
                         BootstrapDialog.alert({
                            type: BootstrapDialog.TYPE_PRIMARY,
                            title: 'Informasi',
                            message: obj.message,
                             
                        });   
                         
                        $("#saksi_modal").modal('hide'); 
                        $('#saksi').DataTable().ajax.reload();                       
                        $('#form_saksi')[0].reset();
                                
                         
                    }
                    else {
                         BootstrapDialog.alert({
                            type: BootstrapDialog.TYPE_DANGER,
                            title: 'Error',
                            message: obj.message ,
                             
                        }); 
                    }
            }
        });
        return false;
}

function surat_update(){
   $('#myPleaseWait').modal('show');
        
        $.ajax({
            url : '<?php echo site_url("$this->controller/surat_update"); ?>',
            data : $("#form_surat_pelepasan").serialize(),
            dataType : 'json',
            type : 'post',
            success : function(obj) {
                $('#myPleaseWait').modal('hide');
                 console.log(obj);
                if(obj.error==false){
                         
                         BootstrapDialog.alert({
                            type: BootstrapDialog.TYPE_PRIMARY,
                            title: 'Informasi',
                            message: obj.message,
                             
                        });   
                         
                        $("#surat_pelepasan_modal").modal('hide'); 
                        $('#surat').DataTable().ajax.reload();                       
                        $('#form_surat_pelepasan')[0].reset();
                                
                         
                    }
                    else {
                         BootstrapDialog.alert({
                            type: BootstrapDialog.TYPE_DANGER,
                            title: 'Error',
                            message: obj.message ,
                             
                        }); 
                    }
            }
        });
        return false;
}

</script>