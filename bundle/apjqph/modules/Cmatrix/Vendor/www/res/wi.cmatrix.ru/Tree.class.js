/**
 * Class Tree
 */
export default class Tree {

    // --- --- --- --- ---
    constructor($tag,opts){
        const Instance = this;
        this.$Tag = $tag;
        
        this.Opts = opts || {};
        
        // @param tree - instance класса
        // @param $node - кликнутый узел
        this.Opts.onClickNode = this.Opts.onClickNode || function(tree,$node){};
        this.Opts.onSelectAll = this.Opts.onSelectAll || function(tree,$node){};
        
        // --- узлы
        this.$Nodes = this.$Tag.find('.cm-tree-node');
        
        // --- кол-во выделенных узлов
        this.CountSelected = 0;
        
        // --- клик по ветке дерева
        this.$Tag.find('.cm-tree-node-label').on('click',function(e){
            const $Current = $(this).parent();
            
            Instance.selectNode($Current,e);
            Instance.Opts.onClickNode(Instance,$Current);
        });
        
        // кнопка выделить всё
        if(this.Opts.buttonSelectAll) this.Opts.buttonSelectAll.on('click',()=>{
            Instance.selectAllNodes();
            Instance.Opts.onSelectAll(Instance,Instance.getSelectedNodes);
        });

    }
    
    /**
     * Выбрать узел 
     * 
     * @param $node
     * @param e
     */
    selectNode($node,e){
        if(e.ctrlKey){
            if($node.hasClass('cm-selected')){
                $node.removeClass('cm-selected');
                this.CountSelected--;
            }
            else{
                $node.addClass('cm-selected');
                this.CountSelected++;
            }
        }
        else{
            this.selectAllNodes(false);
            $node.addClass('cm-selected');
            this.CountSelected = 1;
        }
    }
    
            
    // --- --- --- --- ---
    /**
     * Выбрать узлы по массиву кодов
     * 
     * @param array codes
     */
    selectNodes(codes){
        this.selectAllNodes(false);
        
        return this;
    }

    // --- --- --- --- ---
    /**
     * @param bool select
     *      -true выделить все
     *      -false освободить все
     */
    selectAllNodes(isSelect){
        if(isSelect === false || (isSelect === undefined && this.CountSelected == this.$Nodes.length)){
            this.$Nodes.removeClass('cm-selected');
            this.CountSelected = 0;
        }
        else if(isSelect === true || (isSelect === undefined && this.CountSelected != this.Count)){
            this.$Nodes.addClass('cm-selected');
            this.CountSelected = this.$Nodes.length;
        }
        
    }

    // --- --- --- --- ---
    /**
     * Получить node по code
     */
    getNodeByCode(code){
        return this.$Tag.find('.cm-tree-node[data-code='+code+']');
    }

    // --- --- --- --- ---
    /**
     * Получить первый выбранный узел
     * 
     * return $node
     */
    getSelectedNode(){
        return this.$Tag.find('.cm-tree-node.cm-selected').eq(0);
    }

    // --- --- --- --- ---
    /**
     * Получить все выбранные узлы
     * 
     * return array - массив выбранных узлов
     */
    getSelectedNodes(){
        return this.$Tag.find('.cm-tree-node.cm-selected');
        //.map((index,element) => { return $(element).data('code') }).get();
    }
    
    // --- --- --- --- ---
    scrollToNode(){
        console.log('scrollToNode',this);
        /*
        if(!this.$CurrentNode) return this;
        this.$CurrentNode[0].scrollIntoView();
        return this;
        */
    }

    /*
    // --- --- --- --- ---
    clickNode($node){
        const Instance = this;
        
        
    }

    // --- --- --- --- ---
    activeNode2($node){
        const Instance = this;
        
        const Code = this.getCode($node);
        
        this.$Tag.find('.cm-tree-node').removeClass('cm-active');
        this.$Tag.find('.cm-tree-node[data-code='+Code+']').addClass('cm-active');//[0].scrollIntoView();
            
        // --- скрол дерева
        const $Element = document.querySelector('.cm-tree-node.cm-active');
        if($Element) $Element.scrollIntoView();
    }
    */
    
    /*
    // --- --- --- --- ---
    getNodeCode(){
        if(!this.$CurrentNode) return;
        return this.$CurrentNode.data('code');
    }
    
    // --- --- --- --- ---
    getNodeLabel(){
        if(!this.$CurrentNode) return;
        return this.$CurrentNode.data('label');
    }
    */
    
}