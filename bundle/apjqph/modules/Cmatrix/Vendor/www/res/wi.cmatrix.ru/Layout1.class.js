/**
 * Class Layout1
 */

export default class Layout1 {
    
    // --- --- --- --- ---
    /**
     * @param $tag - tag контейфнера
     */
    constructor($tag){
        this.$Tag = $tag;
        this.$Left = this.$Tag.find('.cm-layout-left');
        this.$Right = this.$Tag.find('.cm-layout-right');
        this.$LayoutBorder = this.$Tag.find('.cm-layout-border');
        this.$SwapButton = $('#cm-layout-swap-button');
        
    }
    
    // --- --- --- --- ---
    init(){
        this.$SwapButton.on('click',()=>{
            this.$Left.toggleClass('cm-visible');
            this.$LayoutBorder.toggleClass('cm-visible');
            this.$SwapButton.toggleClass('cm-open');
        });
        return this;
    }
}
