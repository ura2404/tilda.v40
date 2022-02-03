import Tabs from '../vendor/wi.cmatrix.ru/Tabs.class.js';
import Ajax from '../vendor/wi.cmatrix.ru/Ajax.class.js';
import Form from '../vendor/wi.cmatrix.ru/Form.class.js';

if($('#cm-need-login').length) document.cm.formLogin.show(false);

// --- --- --- --- ---
const onSuccess = function(data){
    //document.cm.formSuccess.content(data.message).show();
    //window.location.reload();
};

// --- --- --- --- ---
const onError = function(data){
    document.cm.formError.content(data.message).show();
};


// --- --- --- --- ---
const tabs = new Tabs($('#cm-module-tabs'));

const formInfo = new Form($('#cm-form-module-info'),onSubmit);


$(document).ready(function(){
    $('#cm-module-baloon')
    .find('.cm-lang-remove').on('click',function(e){
        if($(this).closest('form').attr('disabled') === 'disabled') return;
        
        
        const $Button = $(this);
        const $Baloon = $Button.prev();
        const $Lang = $Baloon.prev();
        //$(this).remove().prev().remove().prev().remove();
        $Button.remove();
        $Baloon.remove();
        $Lang.remove();
    }).end()
    .find('.cm-lang-add').on('click',function(e){
        if($(this).closest('form').attr('disabled') === 'disabled') return;
        
        const $Parent = $(this).parent();
        
        const $Button = $Parent.find('button:not(.wi-hidden)').last();
        const $Baloon = $Button.prev();
        const $Lang = $Baloon.prev();
        
        console.log($Button);
        console.log($Baloon);
        console.log($Lang);
        console.log($Baloon.find('input').val());
        console.log($Lang.find('input').val());
        console.log('>>>',$Baloon.find('input').length);
        console.log('>>>',$Lang.find('input').length);
        
        if(($Baloon.find('input').length && $Lang.find('input').length) && (!$Baloon.find('input').val() || !$Lang.find('input').val())) return;
        
        $Parent.find('.wi-hidden').clone(true).removeClass('wi-hidden').appendTo($Parent);
    });
    
    $('#cm-module-edit').on('click',function(){
        $('form').removeAttr('disabled');
        $(':input').removeAttr('disabled');
        $(this).addClass('wi-hidden').next().removeClass('wi-hidden');
    });
    
    $('#cm-module-save').on('click',function(){
        alert('1');
    });
});

