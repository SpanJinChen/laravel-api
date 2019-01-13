<?php
/**
 * Created by PhpStorm.
 * User: chen
 * Date: 2019/1/1
 * Time: 14:37
 */

namespace App\Http\Controllers\V1\Admin\Rbac;


use App\Http\Controllers\Controller;
use App\Logic\V1\Admin\Rbac\NodeLogic;

class NodeController extends Controller
{
    /**
     * 节点列表
     * @return array
     * @throws \DdvPhp\DdvRestfulApi\Exception\RJsonError
     * @throws \ReflectionException
     */
    public function index(){
        $this->validate(null, [
            'name' => 'string',
            'state' => 'integer',
            'isPage' => 'integer',
            'parentId' => 'integer',
        ]);
        $nodeLogic = new NodeLogic();
        $nodeLogic->load($this->verifyData);
        return $nodeLogic->index();
    }

    /**
     * 添加节点
     * @return array
     * @throws \App\Logic\Exception
     * @throws \DdvPhp\DdvRestfulApi\Exception\RJsonError
     * @throws \ReflectionException
     */
    public function store(){
        $this->validate(null, [
            'name' => 'required|string',
            'icon' => 'required|string',
            'sort' => 'required|integer',
            'state' => 'required|integer',
            'isShow' => 'required|integer',
            'path' => 'required|string',
            'parentId' => 'required|integer',
            'description' => 'required|string',
        ]);
        $nodeLogic = new NodeLogic();
        $nodeLogic->load($this->verifyData);
        if ($nodeLogic->store()){
            return [];
        }
    }

    /**
     * 节点编辑
     * @param $nodeId
     * @return array
     * @throws \App\Logic\Exception
     * @throws \DdvPhp\DdvRestfulApi\Exception\RJsonError
     * @throws \ReflectionException
     */
    public function update($nodeId){
        $this->validate(['nodeId' => $nodeId], [
            'nodeId' => 'required|integer',
            'name' => 'string',
            'icon' => 'string',
            'sort' => 'integer',
            'state' => 'integer',
            'isShow' => 'integer',
            'path' => 'string',
            'parentId' => 'integer',
            'description' => 'string',
        ]);
        $nodeLogic = new NodeLogic();
        $nodeLogic->load($this->verifyData);
        if ($nodeLogic->update()){
            return [];
        }
    }

    /**
     * 节点详情
     * @param $nodeId
     * @return array
     * @throws \App\Logic\Exception
     * @throws \DdvPhp\DdvRestfulApi\Exception\RJsonError
     * @throws \ReflectionException
     */
    public function show($nodeId){
        $this->validate(['nodeId' => $nodeId], [
            'nodeId' => 'required|integer'
        ]);
        $nodeLogic = new NodeLogic();
        $nodeLogic->load($this->verifyData);
        return [
            'data' => $nodeLogic->show()
        ];
    }

    /**
     * 节点删除
     * @return array
     * @throws \App\Logic\Exception
     * @throws \DdvPhp\DdvRestfulApi\Exception\RJsonError
     * @throws \ReflectionException
     */
    public function destroy(){
        $this->validate(null, [
            'nodeIds' => 'required|array'
        ]);
        $nodeLogic = new NodeLogic();
        $nodeLogic->load($this->verifyData);
        if ($nodeLogic->destroy()){
            return [];
        }
    }
}