import Tabs from '../vendor/wi.cmatrix.ru/Tabs.class.js';
import Ajax from '../vendor/wi.cmatrix.ru/Ajax.class.js';
import Window from '../vendor/wi.cmatrix.ru/Window.class.js';
import Form from '../vendor/wi.cmatrix.ru/Form.class.js';

if($('#cm-need-login').length) document.cm.winLogin.show(false);


class Module {
    
    // --- --- --- --- ---
    constructor(){
        const Instance = this;
        
        this.$Tag = $('#cm-module-tabs');
        this.$FormInfo = $('#cm-form-info');
        this.$FormConfirm = $('#cm-form-confirm');
        this.$ButtonEdit = $('#cm-button-module-edit').on('click',() => this.enableEdit());
        this.$ButtonSave = $('#cm-button-module-save').on('click',() => { this.disableEdit(); this.winConfirm.show(); });
        this.$ButtonAddLang = this.$FormInfo.find('.cm-lang-add').on('click',() => this.addLang());
        this.$ButtonRemoveLang = this.$FormInfo.find('.cm-lang-remove').on('click',function(){ Instance.removeLang(this) });
        
        this.tabs = new Tabs(this.$Tag);
        this.formInfo = new Form(this.$FormInfo,() => this.submit);
        
        this.winConfirm = new Window(this.$FormConfirm);
        this.winConfirm.content('Сохранить изменения?');
        
        this.formConfirm = new Form(this.$FormConfirm,() => this.submit);
    }
    
    
    
    /*
    $('#cm-module-info')
    .find('.cm-lang-remove').on('click',function(e){
        if($(this).closest('form').attr('disabled') === 'disabled') return;
        
        const $Button = $(this);
        const $Baloon = $Button.prev();
        const $Lang = $Baloon.prev();
        
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
        
        // если есть поля ввода языка и они не заполненные поля, то игнор
        if(($Baloon.find('input').length && $Lang.find('input').length) && (!$Baloon.find('input').val() || !$Lang.find('input').val())) return;
        
        $Parent.find('.wi-hidden').clone(true).removeClass('wi-hidden').appendTo($Parent);
    });
    */
    
    // --- --- --- --- ---
    submit(){
        alert(1);
    }
    
    // --- --- --- --- ---
    enableEdit(){
        this.$FormInfo.removeAttr('disabled').find('input,textarea').removeAttr('disabled');
        this.$ButtonEdit.addClass('wi-hidden').next().removeClass('wi-hidden');
    }

    // --- --- --- --- ---
    disableEdit(){
        this.$FormInfo.attr('disabled','disabled').find('input,textarea').attr('disabled','disabled');
        this.$ButtonSave.addClass('wi-hidden').prev().removeClass('wi-hidden');
    }
    
    // --- --- --- --- ---
    addLang(){
        if(this.$FormInfo.attr('disabled') === 'disabled') return;
    }
    
    // --- --- --- --- ---
    removeLang(button){
        if(this.$FormInfo.attr('disabled') === 'disabled') return;
        
        $(button).prevUntil('buttom','div').eq(1).remove().end().eq(2).remove();
        
    }
    
}

// --- --- --- --- ---
new Module();




/*

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
const onSubmit = function(url,data){
    alert(123);
    new Ajax({
        url : url
    },onSuccess,onError).commitJson(data);
};

// --- --- --- --- ---
const tabs = new Tabs($('#cm-module-tabs'));
const formInfo = new Form($('#cm-form-module-info'),onSubmit);

const winConfirm = new Window($('#cm-form-confirm'));
winConfirm.content('Сохранить изменения?');

const formConfirm = new Form($('#cm-form-confirm'),onSubmit);

const enableEdit = function(){
    $('#cm-form-module-info').removeAttr('disabled').find('input,textarea').removeAttr('disabled');
    $(this).addClass('wi-hidden').next().removeClass('wi-hidden');
};

const disableEdit = function(){
    $('#cm-form-module-info').attr('disabled','disabled').find('input,textarea').attr('disabled','disabled');
    $(this).addClass('wi-hidden').prev().removeClass('wi-hidden');
};

// --- --- --- --- ---
$(document).ready(function(){
    $('#cm-module-info')
    .find('.cm-lang-remove').on('click',function(e){
        if($(this).closest('form').attr('disabled') === 'disabled') return;
        
        const $Button = $(this);
        const $Baloon = $Button.prev();
        const $Lang = $Baloon.prev();
        
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
        
        // если есть поля ввода языка и они не заполненные поля, то игнор
        if(($Baloon.find('input').length && $Lang.find('input').length) && (!$Baloon.find('input').val() || !$Lang.find('input').val())) return;
        
        $Parent.find('.wi-hidden').clone(true).removeClass('wi-hidden').appendTo($Parent);
    });
    
    $('#cm-module-edit').on('click',function(){
        enableEdit.call(this);
    });
    
    $('#cm-module-save').on('click',function(){
        disableEdit.call(this);
        winConfirm.show();
    });
});
*/