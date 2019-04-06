<?php

namespace App;

class CMSModel extends MainModel
{
    public function getLinks(){
        return MenuItem::where([['entity_id',$this->entity()->id],['entity_item_id',$this->id]])->get();
    }
    public function entity(){
        return Entity::where('table',$this->getTable())->first();
    }
    public function attachTags($tags){
        $this->tags()->detach();
        if($tags && count($tags)) {
            $tags = Tag::whereIn('url',$tags)->get();
            $this->tags()->attach($tags);
        }
    }
}
