<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */

class BaseController extends Controller
{
	/**
	 * Instance of the main Request object.
	 *
	 * @var IncomingRequest|CLIRequest
	 */
	protected $request;

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = ["my_helpers"];


	/**
	 * Constructor.
	 *
	 * @param RequestInterface  $request
	 * @param ResponseInterface $response
	 * @param LoggerInterface   $logger
	 */
	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.: $this->session = \Config\Services::session();
		date_default_timezone_set('Asia/Jakarta');
		$year = date('Y', time());
		$month = date('m', time());
		$this->request = \Config\Services::request();
		$this->session = \Config\Services::session();
		$this->validation = \Config\Services::validation();

		$this->users_model = new \App\Models\UsersModel();
		$this->warehouse = new \App\Models\WarehouseModel();
		$this->warehouse_transaction = new \App\Models\WarehouseTransactionModel();
		$this->unit = new \App\Models\UnitModel();
		$this->order_model = new \App\Models\OrderModel();
		$this->role_model = new \App\Models\RoleModel();
		$this->payment_model = new \App\Models\PaymentModel();
		$this->image_design_model = new \App\Models\ImageDesignModel();
	}


	public function check_login()
	{
		$this->session = \Config\Services::session();
		$is_logged_in = $this->session->get("is_logged_in");

		if ($is_logged_in) {
			// header('location: ' . base_url("Dashboard"));
			// exit();
		} else {
			header('location: ' . base_url("Auth"));
			exit();
		}
	}
}
