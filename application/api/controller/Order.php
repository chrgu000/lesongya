<?php
/**
 * 订单中心.
 * User: whp
 * Date: 2018/10/24
 * Time: 16:15
 */

namespace app\api\controller;

use app\common\model\Order as OrderM;
use think\facade\Cache;

class Order extends Apibase
{

    /*
     *订单列表
     * @return  public  时间 状态 地址信息
     * @return  下单人 昵称 手机号
     * @return  接单人 手机号
     * */
    public function index()
    {
        $order = new OrderM();
        $orderResult = $order->getOrder($this->uid, $this->identity);
        return json(['code' => 200, 'order' => $orderResult]);
    }

    /*
     * 订单详情
     * */
    public function view()
    {
        $id = $this->request->param('id');
        $msg = $this->validate(['id' => $id], 'app\api\validate\Order.view');
        if (true !== $msg) {
            return json(['code' => '202', 'msg' => $msg]);
        }
        if (Cache::store('redis')->has('order'.$id)){
            $order = new OrderM();
            $orderView = $order->getOrderView($id,$this->uid);
            Cache::store('redis')->set('order'.$id);
            return json(['code' => 200, 'vieew' => $orderView]);
        }
        return json(['code' => 200, 'view' =>Cache::store('redis')->get('order'.$id)]);
    }
    /*
     * 骑手下单
     * @param   phone   手机号
     * @param   address 详细地址（明了即可）
     * @param   addname 楼宇/小区名称
     * */
<<<<<<< HEAD

=======
    public function preOrder(){
        $phone = $this->request->param('phone');
        $addid = $this->request->param('addid');
        $address = $this->request->param('address');
        $order = new OrderM();
        $order->phone = $phone;
        $order->address = $address;
        if (empty($order->replace()->save())){
            return json(['code' => 202, 'msg' => showReturnCode('2007'),'turl' => url('')]);
        }else{
            return json(['code' => 200, 'msg' => showReturnCode('2008'),'turl' => url('')]);
        }
    }
    /*
     * 下单成功后，支付信息列表
     * */
    public function payOrder(){

    }
>>>>>>> 93a35c4fa7e9fdfc5b14ac0e331ed2f2e7573f7e
}