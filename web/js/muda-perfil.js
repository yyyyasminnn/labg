$('document').ready(function(){
    $('#dropPerfil').change(function(){
        if($('#dropPerfil').val() == '1'){
            $('#titulo-div-professor').removeAttr('style');
            $('#titulo-div-aluno').attr('style', 'display:none');
            $('#field-professor').removeAttr('style');
            $('#field-aluno').attr('style', 'display:none');
            $('#aluno-matricula').val('');
        }else{
            $('#titulo-div-aluno').removeAttr('style');
            $('#titulo-div-professor').attr('style', 'display:none');
            $('#field-aluno').removeAttr('style');
            $('#field-professor').attr('style', 'display:none');            
            $('#professor-link_curric_lattes').val('');
        }
    });
});