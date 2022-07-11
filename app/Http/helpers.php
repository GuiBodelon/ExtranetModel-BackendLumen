<?php
    /**
     * Global helper Functions
     *
     * @return response()
     */
    /**
     * @param array
     */
    function buildTree(array $arrayList)
    {
        $grouped = [];
        foreach ($arrayList as $node){
            $grouped[$node['parent_id']][] = $node;
        }
        $fnBuilder = function($siblings) use (&$fnBuilder, $grouped) {
            foreach ($siblings as $k => $sibling) {
                $id = $sibling['id'];
                if(isset($grouped[$id])) {
                    $sibling['child'] = $fnBuilder($grouped[$id]);
                }
                $siblings[$k] = $sibling;
            }
            return $siblings;
        };
        return $fnBuilder($grouped[0]);
    }
?>