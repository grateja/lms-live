<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Customer;
use App\Models\DeliveryProfile;
use App\Models\Discount;
use App\Models\Extras;
use App\Models\JobOrder;
use App\Models\JobOrderPayment;
use App\Models\JobOrderProduct;
use App\Models\JobOrderExtras;
use App\Models\JobOrderDeliveryCharge;
use App\Models\JobOrderDiscount;
use App\Models\JobOrderService;
use App\Models\Product;
use App\Models\Service;
use App\Models\Staff;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SyncController extends Controller
{
    public function jobOrder(Request $request, $shopId) {
        \Log::debug($request);
        DB::transaction(function () use ($request, $shopId) {
            if(isset($request->user) && $_staffCreator = $request->user) {
                $_staffCreator['shop_id'] = $shopId;
                $_staffCreator['permissions'] = json_encode($_staffCreator['permissions']);

                $staffCreator = Staff::withTrashed()->find($_staffCreator['id']);

                if($staffCreator == null) {
                    $staffCreator = Staff::create($_staffCreator);
                } else {
                    $staffCreator->update($_staffCreator);
                }
            } else {
                \Log::critical("Sync job order: No staff creator attached in the payload");
            }

            if(isset($request->customer) && $_customer = $request->customer) {
                $customer = Customer::find($_customer['id']);
                if($customer == null) {
                    $_customer['shop_id'] = $shopId;
                    $customer = Customer::create($_customer);
                } else {
                    $customer->update($_customer);
                }
            } else {
                \Log::critical("Sync job order: No customer attached in the payload");
            }

            if(isset($request->jobOrder) && $_jobOrder = $request->jobOrder) {
                $jobOrder = JobOrder::find($_jobOrder['id']);
                if($jobOrder == null) {
                    $_jobOrder['shop_id'] = $shopId;
                    $jobOrder = JobOrder::create($_jobOrder);
                } else {
                    $jobOrder->update($_jobOrder);
                }
            } else {
                \Log::critical("Sync job order: No job order attached in the payload");
            }

            if(isset($request->services) && $_services = $request->services) {
                foreach($_services as $_service) {
                    $_serviceRef = $_service['serviceRef'];

                    unset($_service['serviceRef']);
                    $_service = array_merge($_service, $_serviceRef);

                    $service = JobOrderService::find($_service['id']);
                    if($service != null) {
                        $service->update($_service);
                    } else {
                        $_service['shop_id'] = $shopId;
                        JobOrderService::create($_service);
                    }
                }
            }

            if(isset($request->products) && $_products = $request->products) {
                foreach($_products as $_product) {
                    $product = JobOrderProduct::find($_product['id']);
                    if($product != null) {
                        $product->update($_product);
                    } else {
                        $_product['shop_id'] = $shopId;
                        JobOrderProduct::create($_product);
                    }
                }
            }

            if(isset($request->extras) && $_extras = $request->extras) {
                foreach($_extras as $_extra) {
                    $extra = JobOrderExtras::find($_extra['id']);
                    if($extra != null) {
                        $extra->update($_extra);
                    } else {
                        $_extra['shop_id'] = $shopId;
                        JobOrderExtras::create($_extra);
                    }
                }
            }

            if(isset($request->deliveryCharge) && $_deliveryCharge = $request->deliveryCharge) {
                $deliveryCharge = JobOrderDeliveryCharge::find($_deliveryCharge['id']);
                if($deliveryCharge != null) {
                    $deliveryCharge->update($_deliveryCharge);
                } else {
                    $_deliveryCharge['shop_id'] = $shopId;
                    JobOrderDeliveryCharge::create($_deliveryCharge);
                }
            }

            if(isset($request->discount) && $_discount = $request->discount) {
                $_discount['applicable_to'] = json_encode($_discount['applicable_to']);
                $discount = JobOrderDiscount::find($_discount['id']);
                if($discount != null) {
                    $discount->update($_discount);
                } else {
                    $_discount['shop_id'] = $shopId;
                    JobOrderDiscount::create($_discount);
                }
            }
        });
    }

    public function payment(Request $request, $shopId) {
        \Log::debug($request);
        DB::transaction(function () use ($request, $shopId) {
            if($_paymentStaff = $request->staff) {
                $_paymentStaff['shop_id'] = $shopId;
                $_paymentStaff['permissions'] = json_encode($_paymentStaff['permissions']);

                $paymentStaff = Staff::withTrashed()->find($_paymentStaff['id']);

                if($paymentStaff == null) {
                    $paymentStaff = Staff::create($_paymentStaff);
                } else {
                    $paymentStaff->update($_paymentStaff);
                }
            } else {
                \Log::critical("Sync payment: No staff attached in the payload!");
            }

            if($_jobOrderPayment = $request->payment) {
                $_jobOrderPayment['shop_id'] = $shopId;
                if(isset($_jobOrderPayment['entityCashless']) && $cashless = $_jobOrderPayment['entityCashless']) {
                    unset($_jobOrderPayment['entityCashless']);
                    $_jobOrderPayment = array_merge($_jobOrderPayment, $cashless);
                }

                $jobOrderPayment = JobOrderPayment::withTrashed()->find($_jobOrderPayment['id']);

                if($jobOrderPayment == null) {
                    $jobOrderPayment = JobOrderPayment::create($_jobOrderPayment);
                } else {
                    $jobOrderPayment->update($_jobOrderPayment);
                }

                if(isset($request->jobOrderIds) && $_jobOrderIds = $request->jobOrderIds) {
                    JobOrder::whereIn('id', $_jobOrderIds)->update([
                        'job_order_payment_id' => $_jobOrderPayment['id']
                    ]);
                } else {
                    \Log::critical("Sync payment: No job order ids attached in the payload!");
                }
            } else {
                \Log::critical("Sync payment: No payment attached in the payload!");
            }
        });
    }

    public function bulk(Request $request, $shopId) {
        \Log::debug($request);
        DB::transaction(function () use ($request, $shopId) {
            if($_services = $request->services) {
                foreach($_services as $_service) {
                    $_serviceRef = $_service['serviceRef'];

                    unset($_service['serviceRef']);
                    $_service = array_merge($_service, $_serviceRef);

                    $service = Service::find($_service['id']);
                    if($service != null) {
                        $service->update($_service);
                    } else {
                        $_service['shop_id'] = $shopId;
                        Service::create($_service);
                    }
                }
            }

            if($_extras = $request->extras) {
                foreach($_extras as $_extra) {
                    $extra = Extras::find($_extra['id']);
                    if($extra != null) {
                        $extra->update($_extra);
                    } else {
                        $_extra['shop_id'] = $shopId;
                        Extras::create($_extra);
                    }
                }
            }

            if($_products = $request->products) {
                foreach($_products as $_product) {
                    $product = Product::find($_product['id']);
                    if($product != null) {
                        $product->update($_product);
                    } else {
                        $_product['shop_id'] = $shopId;
                        Product::create($_product);
                    }
                }
            }

            if($_discounts = $request->discounts) {
                foreach($_discounts as $_discount) {
                    $discount = Discount::find($_discount['id']);
                    $_discount['applicable_to'] = json_encode($_discount['applicable_to']);
                    if($discount != null) {
                        $discount->update($_discount);
                    } else {
                        $_discount['shop_id'] = $shopId;
                        Discount::create($_discount);
                    }
                }
            }

            if($_deliveryProfiles = $request->deliveryProfiles) {
                foreach($_deliveryProfiles as $_deliveryProfile) {
                    $deliveryProfile = DeliveryProfile::find($_deliveryProfile['id']);
                    if($deliveryProfile != null) {
                        $deliveryProfile->update($_deliveryProfile);
                    } else {
                        $_deliveryProfile['shop_id'] = $shopId;
                        DeliveryProfile::create($_deliveryProfile);
                    }
                }
            }
        });
    }
}
