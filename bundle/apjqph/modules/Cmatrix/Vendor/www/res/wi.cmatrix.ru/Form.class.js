/**
 * Class Window
 * 
 * Необходимые элементы
 *  - .wi-a-submit - кнопка подтверждения формы
 */

import Window from './Window.class.js';

export default class Form {
    
    // --- --- --- --- ---
    constructor($tag,onSubmit){
        const Instance = this;
        
        this.$Tag = $tag;
        this.Url = undefined;
        this.onSubmit = onSubmit || function(url,data){};
        this.$SubmitButton = this.$Tag.find('.wi-a-submit');
        
        this.Data = {};
        
        // --- init --- --- --- ---
        const Url = this.$Tag.attr('action');
        if(Url) this.Url = Url;
        
        if(/*this.Url &&*/ this.$SubmitButton.length){
            this.$Tag.on('submit',function(e){
                e.preventDefault();
                Instance.submit();
            });
            
            this.$SubmitButton.on('click',function(e){
                Instance.$Tag.submit();
            });
        }
        
    }
    
    // --- --- --- --- ---
    enable(){
        const Instance = this;
        
        // 1. убрать атрибут disabled, очистить поля, назначить enter
        this.$Tag.removeAttr('disabled').find('input,textarea,select').removeAttr('disabled');
        
        // 2. очистить поля
        //this.$Tag.find(':input').filter((index, element) => $(element).is('input:not(:hidden)')).map((index, element) => $(element).removeClass('cm-invalid').next().text('').end().val(''));
        
        // 3. назначить enter на все поля
        this.$Tag.find(':input:not(:hidden)').on('keyup',function(e){
            if(e.keyCode == 13) Instance.$Tag.submit();
        }).on('focusin',function(e){
            $(this).data('val',$(this).val());
        }).on('change',function(e){
        });
        
        // 4. фокус на первое поле
        this.focus();
        
        this.Data = this.$Tag.serializeArray();
        console.log(this.Data);
        
        return this;
    }
    
    // --- --- --- --- ---
    disable(){
        // 1. установить атрибут disabled
        this.$Tag.attr('disabled','disabled').find('input,textarea,select').attr('disabled','disabled').off('keyup');
        
        // 2.отменить enter на все поля
        this.$Tag.find(':input:not(:hidden)').off('keyup');
        
        return this;
    }
    
    // --- --- --- --- ---
    rollback(){
        this.$Tag.find(':input:not(:hidden)').map((index,element) => {
            const $Element = $(element);
            if($Element.data('val')) $(element).val($Element.data('val'));
        });
    }

    // --- --- --- --- ---
    focus(){
        this.$Tag.find('input[required="required"]:not(:hidden):first').focus();
        return this;
    }
    
    // --- --- --- --- ---
    isRequired(){
        const Flag = this.$Tag.find(':input:not(.wi-hidden)').map(function(index, element){
            //if(!$(element).hasAttr('required')) return;
            
            $(element).next('.wi-err').text('');
            if(!element.validity.valid) $(element)/*.addClass('wi-invalid')*/.next('.wi-err').text(element.validationMessage);
            
            return element.validity.valid;
        }).get().every((current,index,array) => !!current);
        
        if(!Flag) this.$Tag.find(':input:not(.wi-hidden):invalid').eq(0).focus();
        
        return Flag;
    }
    
    // --- --- --- --- ---
    data(){
        return this.$Tag.serializeArray();
        
        /*
        let Data = {};
        //this.$Tag.find(':input').filter((index, element) =>$(element).is('input')).map((index, element) => {
        this.$Tag.find('input,textarea,select').map((index, element) => {
            const Name = $(element).attr('name');
            Data[Name] = $(element).attr('type') === 'password' ? $.md5($(element).val()) : $(element).val();
        });
        
        return Data;
        */
    }
    
    // --- --- --- --- ---
    submit(){
        if(!this.isRequired()) return;
        
        let Data = {};
        this.$Tag.find(':input').filter((index, element) =>$(element).is('input')).map((index, element) => {
            const Name = $(element).attr('name');
            Data[Name] = $(element).attr('type') === 'password' ? $.md5($(element).val()) : $(element).val();
        });
        
        //console.log('submit data',Data);
        this.onSubmit(this.Url,Data);
        
        return this;
    }
}