/**
 * Class Window
 * 
 * Необходимые элементы
 *  - .wi-a-submit - кнопка подтверждения формы
 */

import Window from './Window.class.js';

export default class Form extends Window {
    
    // --- --- --- --- ---
    constructor($tag,onSubmit){
        super($tag);
        const Instance = this;
        
        this.Url = undefined;
        this.onSubmit = onSubmit || function(url,data){};
        this.$SubmitButton = this.$Tag.find('.wi-a-submit');
        
        // --- init --- --- --- ---
        const Url = this.$Tag.attr('action');
        if(Url) this.Url = Url;
        
        if(this.Url && this.$SubmitButton.length){
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
    show(isHidable){
        const Instance = this;
        super.show(isHidable);
        
        // 1. очистить поля
        this.$Tag.find(':input').filter((index, element) => $(element).is('input:not(:hidden)')).map((index, element) => $(element).removeClass('cm-invalid').next().text('').end().val(''));
        
        // 2. фокус на первое поле
        this.$Tag.find('input[required="required"]:not(:hidden):first').focus();
        
        // 3. назначить enter на все поля
        this.$Tag.find(':input:not(:hidden)').on('keyup',function(e){
            if(e.keyCode == 13) Instance.$Tag.submit();
        });
        
        return this;
    }
    
    // --- --- --- --- ---
    hide(){
        const Instance = this;
        super.hide();
        
        // 1.отменить enter на все поля
        this.$Tag.find(':input:not(:hidden)').off('keyup');
        
        return this;
    }
    
    // --- --- --- --- ---
    focus(){
        this.$Tag.find('input[required="required"]:not(:hidden):first').focus();
    }
    
    // --- --- --- --- ---
    isRequired(){
        return this.$Tag.find(':input').map(function(index, element){
            if(!$(element).hasAttr('required')) return;
            
            $(element).removeClass('wi-invalid').next().text('');
            if(! element.validity.valid) $(element).addClass('wi-invalid').next().text(element.validationMessage);
            
            return element.validity.valid;
        }).get().every((current,index,array) => !!current);
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
    }
}





class Form123 extends Window {
    
    // --- --- --- --- ---
    /**
     * @param $tag - tag контейфнера формы, tag фона на весь экран
     */
    constructor($tag,onSubmit){
        super($tag);
        
        this.Url       = undefined;
        //this.onSuccess = undefined;
        //this.onError   = undefined;
        this.onSubmit  = onSubmit;
    }
    
    // --- --- --- --- ---
    init(){
        const Instance = this;
        super.init();
        
        if(!this.Url) this.Url = this.$Tag.attr('action');
        
        const SubmitButton = this.$Tag.find('.cm-a-submit');
        
        // если есть url и submitbutton
        if(this.Url && SubmitButton){
            this.$Tag.on('submit',function(e){
                e.preventDefault();
                Instance.submit();
            });
            
            SubmitButton.on('click',function(e){
                Instance.$Tag.submit();
            });
        }
        
        return this;
    }
    
    // --- --- --- --- ---
    show(isHidable){
        const Instance = this;
        super.show(isHidable);
        
        // очистить поля
        this.$Tag.find(':input').filter((index, element) => $(element).is('input:not(:hidden)')).map((index, element) => $(element).removeClass('cm-invalid').next().text('').end().val(''));
        
        // фокус на первое поле
        this.$Tag.find('input:not(:hidden):first').focus();
        
        // назначить enter на все поля
        this.$Tag.find(':input').on('keyup',function(e){
            if(e.keyCode == 13) Instance.$Tag.submit();
        });
        
        return this;
    }    
    
    // --- --- --- --- ---
    hide(){
        const Instance = this;
        super.hide();
        
        // отменить enter на все поля
        this.$Tag.find(':input').off('keyup');
    }
    
    // --- --- --- --- ---
    required(){
        return this.$Tag.find(':input').map(function(index, element){
            if(!$(element).hasAttr('required')) return;
            
            $(element).removeClass('cm-invalid').next().text('');
            if(! element.validity.valid) $(element).addClass('cm-invalid').next().text(element.validationMessage);
            
            return element.validity.valid;
        }).get().every((current,index,array) => !!current);
    }

    // --- --- --- --- ---
    submit(){
        //console.log('submit');
        
        if(typeof this.onSubmit === 'function' && this.required()){
            let Data = {};
            this.$Tag.find(':input').filter((index, element) =>$(element).is('input')).map((index, element) => {
                const Name = $(element).attr('name');
                Data[Name] = Name === 'p' ? $.md5($(element).val()) : $(element).val();
            });
            
            this.onSubmit(this.Url,Data);
        }
        return this;
    }
}