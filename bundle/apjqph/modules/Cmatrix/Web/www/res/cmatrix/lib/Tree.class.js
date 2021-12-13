/**
 * Class Tree
 */
export default class Tree {

    // --- --- --- --- ---
    constructor($tag,opts){
        const Instance = this;
        this.$Tag = $tag;
        
        this.Opts = opts || {};
        this.Opts.onClickNode = this.Opts.onClickNode || function(node){};
        
        // --- текущий узел (по клику)
        this.$CurrentNode;
        
        // --- узлы
        this.$Nodes = this.$Tag.find('.cm-tree-node');
        
        // --- кол-во выделенных узлов
        this.CountSelected = 0;
        
        // --- клик по ветке дерева
        this.$Tag.find('.cm-tree-node-label').on('click',function(e){
            console.log(e.ctrlKey);
            
            Instance.$CurrentNode = $(this).parent();
            //if(Instance.$CurrentNode.hasClass('cm-active')) return;
            
            Instance.activeNode();
            Instance.Opts.onClickNode(Instance.$CurrentNode);
        });
    }
    
    // --- --- --- --- ---
    getNode(code){
        this.$CurrentNode = this.$Tag.find('.cm-tree-node[data-code='+code+']');
        return this;
    }

    // --- --- --- --- ---
    activeNode(){
        if(!this.$CurrentNode) return this;
        
        this.$Tag.find('.cm-tree-node').removeClass('cm-active');
        this.$CurrentNode.addClass('cm-active');
        
        return this;
    }

    // --- --- --- --- ---
    unactiveNode(){
        if(!this.$CurrentNode) return this;
        this.$CurrentNode.removeClass('cm-active');
    }

    // --- --- --- --- ---
    /**
     * @param bool select
     *      -true выделить все
     *      -false освободить все
     */
    activeAllNodes(select){
        if(select === false || (select === undefined && this.CountSelected == this.$Nodes.length)){
            this.$Nodes.removeClass('cm-selected');
            this.CountSelected = 0;
        }
        else if(select === true || (select === undefined && this.CountSelected != this.Count)){
            this.$Nodes.addClass('cm-selected');
            this.CountSelected = this.Count;
        }
        
    }
    
    // --- --- --- --- ---
    scrollToNode(){
        if(!this.$CurrentNode) return this;
        this.$CurrentNode[0].scrollIntoView();
        return this;
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
    
}