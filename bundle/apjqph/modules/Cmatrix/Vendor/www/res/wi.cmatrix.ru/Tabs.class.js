/**
 * Class Tabs
 */

export default class Tabs {
    
    // --- --- --- --- ---
    constructor($tag){
        const Instance = this;
        this.$Tag = $tag;
        this.$Items = this.$Tag.find('.wi-tabs-items');
        this.$Tabs = this.$Items.find('.wi-tabs-item');
        this.$Contents = this.$Tag.find('.wi-tabs-content');
        this.$Active = this.$Items.find('.wi-active');
        if(!this.$Active.length) this.$Active = this.$Tabs.eq(0);
        
        // --- --- --- --- ---
        // отразить активную табу
        if(this.$Active.length){
            this.$Active.addClass('wi-active');
            const Tag = this.$Active.data('tag');
            $(Tag).addClass('wi-active');
        }
        
        // --- --- --- --- ---
        // клик по табе
        this.$Tabs.on('click',function(e){
            Instance.active(e,$(this));
        });
    }
    
    // --- --- --- --- ---
    /**
     * Активация табы
     */
    active(e,$tag){
        const OldDest = this.$Active.data('tag');
        const NewDest = $tag.data('tag');
        
        this.$Active.removeClass('wi-active');
        this.$Active = $tag;
        this.$Active.addClass('wi-active');
        
        $(OldDest).removeClass('wi-active');
        $(NewDest).addClass('wi-active');
    }

}
