<?php
class ControllerSaleInpostParcel extends Controller
{
	private $error = array();

	public function index()
	{
		$this->load->language('sale/inpost_parcel');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('module/inpost');

		$this->getList();
 	}

	///
	// update function
	//
	public function update()
	{
		$this->load->language('sale/inpost_parcel');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('module/inpost');
    	
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm())
		{
			$this->model_module_inpost->editParcel($this->request->get['order_id'], $this->request->post);
	  		
			$this->session->data['success'] = $this->language->get('text_success');
	  
			$url = '';

			if (isset($this->request->get['filter_order_id'])) {
				$url .= '&filter_order_id=' . $this->request->get['filter_order_id'];
			}
			
			if (isset($this->request->get['filter_customer'])) {
				$url .= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
			}
												
			if (isset($this->request->get['filter_order_status_id'])) {
				$url .= '&filter_order_status_id=' . $this->request->get['filter_order_status_id'];
			}
			
			if (isset($this->request->get['filter_total'])) {
				$url .= '&filter_total=' . $this->request->get['filter_total'];
			}
						
			if (isset($this->request->get['filter_date_added'])) {
				$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
			}
			
			if (isset($this->request->get['filter_date_modified'])) {
				$url .= '&filter_date_modified=' . $this->request->get['filter_date_modified'];
			}
													
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			
			$this->redirect($this->url->link('sale/inpost_parcel', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
		
    	$this->getForm();
  	}
	
  	public function delete() {
		$this->load->language('sale/order');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('sale/order');

    	if (isset($this->request->post['selected']) && ($this->validateDelete())) {
			foreach ($this->request->post['selected'] as $order_id) {
				$this->model_sale_order->deleteOrder($order_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_order_id'])) {
				$url .= '&filter_order_id=' . $this->request->get['filter_order_id'];
			}
			
			if (isset($this->request->get['filter_customer'])) {
				$url .= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
			}
												
			if (isset($this->request->get['filter_order_status_id'])) {
				$url .= '&filter_order_status_id=' . $this->request->get['filter_order_status_id'];
			}
			
			if (isset($this->request->get['filter_total'])) {
				$url .= '&filter_total=' . $this->request->get['filter_total'];
			}
						
			if (isset($this->request->get['filter_date_added'])) {
				$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
			}
			
			if (isset($this->request->get['filter_date_modified'])) {
				$url .= '&filter_date_modified=' . $this->request->get['filter_date_modified'];
			}
													
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->redirect($this->url->link('sale/order', 'token=' . $this->session->data['token'] . $url, 'SSL'));
    	}

    	$this->getList();
  	}

	///
	// getList function
	//
	// @brief Build a list of the current parcels
	//
	private function getList()
	{
		if (isset($this->request->get['filter_order_id'])) {
			$filter_order_id = $this->request->get['filter_order_id'];
		} else {
			$filter_order_id = null;
		}

		if (isset($this->request->get['filter_parcel_id'])) {
			$filter_parcel_id = $this->request->get['filter_parcel_id'];
		} else {
			$filter_parcel_id = null;
		}

		if (isset($this->request->get['filter_target_machine_id'])) {
			$filter_target_machine_id = $this->request->get['filter_target_machine_id'];
		} else {
			$filter_target_machine_id = null;
		}
		
		if (isset($this->request->get['filter_parcel_status'])) {
			$filter_parcel_status = $this->request->get['filter_parcel_status'];
		} else {
			$filter_parcel_status = null;
		}
		
		if (isset($this->request->get['filter_creation_date'])) {
			$filter_creation_date = $this->request->get['filter_creation_date'];
		} else {
			$filter_creation_date = null;
		}
		
		if (isset($this->request->get['filter_sticker_creation_date'])) {
			$filter_sticker_creation_date = $this->request->get['filter_sticker_creation_date'];
		} else {
			$filter_sticker_creation_date = null;
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'order_id';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'DESC';
		}
		
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
				
		$url = '';

		if (isset($this->request->get['filter_order_id'])) {
			$url .= '&filter_order_id=' . $this->request->get['filter_order_id'];
		}
		
		if (isset($this->request->get['filter_parcel_id'])) {
			$url .= '&filter_parcel_id=' . $this->request->get['filter_parcel_id'];
		}
											
		if (isset($this->request->get['filter_parcel_status'])) {
			$url .= '&filter_parcel_status=' . $this->request->get['filter_parcel_status'];
		}
		
		if (isset($this->request->get['filter_target_machine_id'])) {
			$url .= '&filter_target_machine_id=' . $this->request->get['filter_target_machine_id'];
		}
					
		if (isset($this->request->get['filter_creation_date'])) {
			$url .= '&filter_creation_date=' . $this->request->get['filter_creation_date'];
		}
		
		if (isset($this->request->get['filter_sticker_creation_date'])) {
			$url .= '&filter_sticker_creation_date=' . $this->request->get['filter_sticker_creation_date'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
		
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      			'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('sale/inpost_parcel', 'token=' . $this->session->data['token'] . $url, 'SSL'),
      			'separator' => ' :: '
   		);

		$this->data['create'] = $this->url->link('sale/inpost_parcel/create',
			'token=' . $this->session->data['token'], 'SSL');
		$this->data['cancel'] = $this->url->link('sale/inpost_parcel/cancel',
			'token=' . $this->session->data['token'], 'SSL');
		$this->data['modify'] = $this->url->link('sale/inpost_parcel/modify',
			'token=' . $this->session->data['token'], 'SSL');
		$this->data['labels'] = $this->url->link('sale/inpost_parcel/labels',
			'token=' . $this->session->data['token'], 'SSL');

		$this->data['parcels'] = array();

		$data = array(
			'filter_order_id'      => $filter_order_id,
			'filter_parcel_id'     => $filter_parcel_id,
			'filter_parcel_status' => $filter_parcel_status,
			'filter_target_machine_id' => $filter_target_machine_id,
			'filter_creation_date' => $filter_creation_date,
			'filter_sticker_creation_date' => $filter_sticker_creation_date,
			'sort'                 => $sort,
			'order'                => $order,
			'start'                => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit'                => $this->config->get('config_admin_limit')
		);

		$order_total = $this->model_module_inpost->getTotalParcels($data);
		$results = $this->model_module_inpost->getParcels($data);

		foreach ($results as $result)
		{
			$action = array();

			$action[] = array(
				'text' => $this->language->get('text_view'),
				'href' => $this->url->link('sale/inpost_parcel/info', 'token=' . $this->session->data['token'] . '&order_id=' . $result['order_id'] . $url, 'SSL')
			);

			if (strtotime($result['creation_date']) > strtotime('-' . (int)$this->config->get('config_order_edit') . ' day')) {
				$action[] = array(
					'text' => $this->language->get('text_edit'),
					'href' => $this->url->link('sale/inpost_parcel/update', 'token=' . $this->session->data['token'] . '&order_id=' . $result['order_id'] . $url, 'SSL')
				);
			}
			
			$this->data['orders'][] = array(
				'order_id'      => $result['order_id'],
				'parcel_id'     => $result['parcel_id'],
				'parcel_status' => $result['parcel_status'],
				'file_name'     => $result['file_name'],
				'parcel_target_machine_id' => $result['parcel_target_machine_id'],
				'creation_date' => date($this->language->get('date_format_short'), strtotime($result['creation_date'])),
				'sticker_creation_date' =>
				($result['sticker_creation_date'] == null ? '' : date($this->language->get('date_format_short'), strtotime($result['sticker_creation_date']))),
				'selected'      => isset($this->request->post['selected']) && in_array($result['order_id'], $this->request->post['selected']),
				'action'        => $action
			);
		}

		$this->data['heading_title']     = $this->language->get('heading_title');

		$this->data['text_no_results']   = $this->language->get('text_no_results');
		$this->data['text_missing']      = $this->language->get('text_missing');

		$this->data['column_order_id']   = $this->language->get('column_order_id');
		$this->data['column_parcel_id']  = $this->language->get('column_parcel_id');
		$this->data['column_parcel_status']     = $this->language->get('column_parcel_status');
		$this->data['column_target_machine_id'] = $this->language->get('column_target_machine_id');
		$this->data['column_creation_date'] = $this->language->get('column_creation_date');
		$this->data['column_file_name']     = $this->language->get('column_file_name');
		$this->data['column_sticker_creation_date'] = $this->language->get('column_sticker_creation_date');
		$this->data['column_action'] = $this->language->get('column_action');

		$this->data['button_create'] = $this->language->get('button_create');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['button_modify'] = $this->language->get('button_modify');
		$this->data['button_labels'] = $this->language->get('button_labels');
		$this->data['button_filter'] = $this->language->get('button_filter');

		$this->data['token'] = $this->session->data['token'];
		
		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}

		$url = '';

		if (isset($this->request->get['filter_order_id'])) {
			$url .= '&filter_order_id=' . $this->request->get['filter_order_id'];
		}

		if (isset($this->request->get['filter_parcel_id'])) {
			$url .= '&filter_parcel_id=' . $this->request->get['filter_parcel_id'];
		}

		if (isset($this->request->get['filter_parcel_status'])) {
			$url .= '&filter_parcel_status=' . $this->request->get['filter_parcel_status'];
		}
		
		if (isset($this->request->get['filter_target_machine_id'])) {
			$url .= '&filter_target_machine_id=' . $this->request->get['filter_target_machine_id'];
		}
					
		if (isset($this->request->get['filter_creation_date'])) {
			$url .= '&filter_creation_date=' . $this->request->get['filter_creation_date'];
		}
		
		if (isset($this->request->get['filter_sticker_creation_date'])) {
			$url .= '&filter_sticker_creation_date=' . $this->request->get['filter_sticker_creation_date'];
		}

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$this->data['sort_order'] = $this->url->link('sale/inpost_parcel', 'token=' . $this->session->data['token'] . '&sort=order_id' . $url, 'SSL');
		$this->data['sort_parcel_id'] = $this->url->link('sale/inpost_parcel', 'token=' . $this->session->data['token'] . '&sort=parcel_id' . $url, 'SSL');
		$this->data['sort_parcel_status'] = $this->url->link('sale/inpost_parcel', 'token=' . $this->session->data['token'] . '&sort=parcel_status' . $url, 'SSL');
		$this->data['sort_target_machine_id'] = $this->url->link('sale/inpost_parcel', 'token=' . $this->session->data['token'] . '&sort=parcel_target_machine_id' . $url, 'SSL');
		$this->data['sort_creation_date'] = $this->url->link('sale/inpost_parcel', 'token=' . $this->session->data['token'] . '&sort=creation_date' . $url, 'SSL');
		$this->data['sort_sticker_creation_date'] = $this->url->link('sale/inpost_parcel', 'token=' . $this->session->data['token'] . '&sort=sticker_creation_date' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['filter_order_id'])) {
			$url .= '&filter_order_id=' . $this->request->get['filter_order_id'];
		}
		
		if (isset($this->request->get['filter_parcel_id'])) {
			$url .= '&filter_parcel_id=' . $this->request->get['filter_parcel_id'];
		}
											
		if (isset($this->request->get['filter_parcel_status'])) {
			$url .= '&filter_parcel_status=' . $this->request->get['filter_parcel_status'];
		}
		
		if (isset($this->request->get['filter_target_machine_id'])) {
			$url .= '&filter_target_machine_id=' . $this->request->get['filter_target_machine_id'];
		}
					
		if (isset($this->request->get['filter_creation_date'])) {
			$url .= '&filter_creation_date=' . $this->request->get['filter_creation_date'];
		}
		
		if (isset($this->request->get['filter_sticker_creation_date'])) {
			$url .= '&filter_sticker_creation_date=' . $this->request->get['filter_sticker_creation_date'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination        = new Pagination();
		$pagination->total = $order_total;
		$pagination->page  = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->text  = $this->language->get('text_pagination');
		$pagination->url   = $this->url->link('sale/inpost_parcel', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$this->data['pagination'] = $pagination->render();

		$this->data['filter_order_id']          = $filter_order_id;
		$this->data['filter_parcel_id']         = $filter_parcel_id;
		$this->data['filter_parcel_status']     = $filter_parcel_status;
		$this->data['filter_target_machine_id'] = $filter_target_machine_id;
		$this->data['filter_creation_date']     = $filter_creation_date;
		$this->data['filter_sticker_creation_date'] = $filter_sticker_creation_date;

		$this->data['sort'] = $sort;
		$this->data['order'] = $order;

		$this->template = 'sale/parcel_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
		
		$this->response->setOutput($this->render());
  	}

	///
	// validateForm function
	//
	private function validateForm()
	{
		if (!$this->user->hasPermission('modify', 'sale/inpost_parcel'))
		{
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen($this->request->post['machine_id']) < 1) || (utf8_strlen($this->request->post['machine_id']) > 11))
		{
      			$this->error['target_machine_id'] = $this->language->get('error_machine_id');
		}

    	if ((utf8_strlen($this->request->post['email']) > 96) || (!preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $this->request->post['email']))) {
      		$this->error['email'] = $this->language->get('error_email');
    	}
		
    	if ((utf8_strlen($this->request->post['mobile']) < 9) || (utf8_strlen($this->request->post['mobile']) > 9)) {
      		$this->error['mobile'] = $this->language->get('error_mobile');
    	}

		$t_size = utf8_strtoupper($this->request->post['size']);
		if ((utf8_strlen($this->request->post['size']) != 1) ||
			($t_size != 'A' && $t_size != 'B' && $t_size != 'C') )
		{
      			$this->error['size'] = $this->language->get('error_size');
    		}

		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}
		
		if (!$this->error) {
	  		return true;
		} else {
	  		return false;
		}
  	}    
	
	///
	// create function
	//
	// @brief create the parcel(s).
	//
	public function create()
	{
		$this->language->load('sale/inpost_parcel');

		$json = array();

		$this->data['orders'] = array();

		$orders = array();

		if (isset($this->request->post['selected']))
		{
			$orders = $this->request->post['selected'];
		}
		elseif (isset($this->request->get['order_id']))
		{
			$orders[] = $this->request->get['order_id'];
		}
		
		$this->load->library('inpostparcels');
		$this->load->model('module/inpost');

		// Need to create our own object.
		$object_ip = new Inpostparcels();

		// Get the config details for URL & key.
		$api_url = $this->config->get('inpost_api_url');
		$api_key = $this->config->get('inpost_api_key');

		$this->log->write('url = ' . $api_url . ' key = ' . $api_key);

		foreach ($orders as $order_id)
		{
			$ret = $this->model_module_inpost->getParcelDetails($order_id);

			// Check that the search finds the Order # in the
			// table and that the Parcel has not already been
			// created.
			if($ret == null || count($ret) == 0 ||
				$ret[0]['parcel_id'] != '' ||
				$ret[0]['parcel_status'] == "Cancelled")
			{
				continue;
			}

			$arr = explode(':', $ret[0]['variables']);

			$params = array(
				'url'           => $api_url . 'parcels',
				'token'         => $api_key,
				'methodType'    => 'POST',
				'params' => array(
				'description'   => 'Order :' . $order_id,
				'receiver' => array(
					'phone' => $arr[0],
					'email' => $arr[2]
				),
				'size'           => $arr[1],
				'tmp_id'         => $object_ip->generate(4, 15),
				'target_machine' => $ret[0]['parcel_target_machine_id'],
			)
			);

			$reply = $object_ip->connectInpostparcels($params);

			if($reply['info']['http_code'] == '201')
			{
				$parcel_id = $reply['result']->id;
				$this->model_module_inpost->setParcelId(
					$order_id, $reply['result']->id);
			}
			else
			{
				$this->log->write("Failed to create parcel. Error code: " . $reply['info']['http_code']);
				$this->session->data['success'] = "Failed to create parcel. Error code: " . $reply['info']['http_code'];
			}

			if(!$json)
			{
				// Now pay for the parcel
				$params['url']        = $api_url .
					'parcels/' .
					$parcel_id . '/pay';
				$params['token']      = $api_key;
				$params['methodType'] = 'POST';
				$params['params']     = array();

				$reply = $object_ip->connectInpostparcels($params);
				if($reply['info']['http_code'] == '204')
				{
					$this->log->write('Parcel is paid for.');
				}
				else
				{
					// Failed to pay for a parcel.
					// Tell the user.
					//$json['error'] = "Failed to pay for parcel. Error code: " . $reply['info']['http_code'];
					$this->session->data['success'] = "Failed to pay for parcel. Error code: " . $reply['info']['http_code'];
					$this->log->write("Failed to pay for parcel. Error code: " . $reply['info']['http_code']);
				}
			}

			if(!$json)
			{
				// Now get the details for the parcel
				$params['url']        = $api_url .
					'parcels/' .
					$parcel_id;
				$params['token']      = $api_key;
				$params['methodType'] = 'GET';
				$params['params']     = array();

				$reply = $object_ip->connectInpostparcels($params);

				if($reply['info']['http_code'] == '200')
				{
					$this->model_module_inpost->setParcelDetails(
						$order_id, $reply['result']);
				}
			}
		}

		//$this->response->setOutput(json_encode($json));
		$token = $this->session->data['token'];
		$this->redirect($this->url->link('sale/inpost_parcel&token=' .
			$token, '', 'SSL'));
  	}

	///
	// labels function
	//
	// @brief Create the label(s) for parcels
	//
	public function labels()
	{
		$this->language->load('sale/inpost_parcel');

		$this->data['title'] = $this->language->get('heading_title');

		if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
			$this->data['base'] = HTTPS_SERVER;
		} else {
			$this->data['base'] = HTTP_SERVER;
		}

		$this->load->model('module/inpost');

		if ($this->request->server['REQUEST_METHOD'] == 'POST')
		{
			$url = '';

			$json = array();

			$this->data['orders'] = array();

			$orders = array();

			if (isset($this->request->post['selected']))
			{
				$orders = $this->request->post['selected'];
			}
			elseif (isset($this->request->get['order_id']))
			{
				$orders[] = $this->request->get['order_id'];
			}
		
			$this->load->library('inpostparcels');
			$this->load->model('module/inpost');

			// Need to create our own object.
			$object_ip = new Inpostparcels();

			// Get the config details for URL & key.
			$api_url = $this->config->get('inpost_api_url');
			$api_key = $this->config->get('inpost_api_key');

			$parcel_sticker = array();

			foreach ($orders as $order_id)
			{
				$ret = $this->model_module_inpost->getParcelDetails($order_id);

				// Check that the search finds the Order # in the
				// table and that the Parcel has not already been
				// created.
				if($ret == null || count($ret) == 0 ||
					$ret[0]['sticker_creation_date'] != null
				|| $ret[0]['parcel_status'] == 'Cancelled')
				{
					$this->log->write('Labels, continiuing...');
					continue;
				}

				$parcel_sticker[] = $ret[0]['parcel_id'];
			}

			if(count($parcel_sticker) > 0)
			{
				if(count($parcel_sticker) > 1)
				{
					$parcel_list = implode(';', $parcel_sticker);
				}
				else
				{
					$parcel_list = $parcel_sticker[0];
				}


				$params['url']        = $api_url .
					'stickers/' .
					$parcel_list;
				$params['token']      = $api_key;
					$params['methodType'] = 'GET';
				$params['params']     = array(
					'format' => 'pdf',
					'id'     => $parcel_list,
					'type'   => 'normal'
				);

				$reply = $object_ip->connectInpostparcels($params);

				if($reply['info']['http_code'] == '200')
				{
				// Try and save the PDF as a local (server) file
				$base_name = '/pdf_files/' . 'stickers_' .
					date('Y-m-d_H-i-s') . '.pdf';
				$dir_filename = dirname(__FILE__) .
					$base_name;
				$filename     = HTTP_SERVER . 'controller/sale' . $base_name;

				$file = fopen($dir_filename, 'wb');

				$this->log->write('Labels, file= ' . $filename);

				if($file != false)
				{
				fwrite($file, base64_decode($reply['result']));

					fclose($file);

					$this->model_module_inpost->setParcelStickerDate(
						$parcel_list,
						$filename);

					$this->session->data['success'] = $this->language->get('text_success');
				}
				}
				else
				{
					//$this->error['warning'] = 
					$this->session->data['success'] = 
						"Failed to create labels for parcel. Error code: " .
						$reply['info']['http_code'];
					if (isset($this->error['warning']))
					{
						$this->data['error_warning'] = $this->error['warning'];
					}
					else
					{
						$this->data['error_warning'] = '';
					}
				}
			}

			//$this->template = 'sale/parcel_list.tpl';
			//$this->children = array(
				//'common/header',
				//'common/footer'
			//);

			//$this->response->setOutput($this->render());
//			$this->redirect($this->url->link('sale/inpost_parcel', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		//$this->template = 'sale/parcel_list.tpl';

		//$this->response->setOutput(json_encode($json));
		//$this->response->setOutput($this->render());
		//$this->getList();

		//$token = $this->session->data['token'];
		//$this->redirect($this->url->link('sale/inpost_parcel&token=' .
		//	$token, '', 'SSL'));
		$this->redirect($this->url->link('sale/inpost_parcel', 'token=' . $this->session->data['token'] . $url, 'SSL'));
	}

	///
	// cancel function
	//
	// @brief Try and cancel the selected parcel.
	//
	public function cancel()
	{
		$this->language->load('sale/inpost_parcel');

		$this->data['title'] = $this->language->get('heading_title');

		if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
			$this->data['base'] = HTTPS_SERVER;
		} else {
			$this->data['base'] = HTTP_SERVER;
		}

		$this->load->model('module/inpost');

		if ($this->request->server['REQUEST_METHOD'] == 'POST')
		{
			$url = '';

			$json = array();

			$this->data['orders'] = array();

			$orders = array();

			if (isset($this->request->post['selected']))
			{
				$orders = $this->request->post['selected'];
			}
			elseif (isset($this->request->get['order_id']))
			{
				$orders[] = $this->request->get['order_id'];
			}
		
			$this->load->library('inpostparcels');
			$this->load->model('module/inpost');

			// Need to create our own object.
			$object_ip = new Inpostparcels();

			// Get the config details for URL & key.
			$api_url = $this->config->get('inpost_api_url');
			$api_key = $this->config->get('inpost_api_key');

			foreach ($orders as $order_id)
			{
				$ret = $this->model_module_inpost->getParcelDetails($order_id);

				if($ret == null || count($ret) == 0 ||
				   $ret[0]['parcel_status'] == 'Cancelled')
				{
					$this->log->write('Cancel, continiuing...');
					continue;
				}

				// Check to see if the parcel is partially
				// created but not actually sent to InPost in
				// any way. I.e. not parcel ID.
				if($ret != null && $ret[0]['parcel_id'] == '')
				{
					// Simply update status.
					$this->model_module_inpost->setParcelToCancelled($order_id);
					$this->log->write('Cancel, updated as no parcel created, yet...');
					continue;
				}

				//if($ret[0]['sticker_creation_date'] == null)
				//{
					$reply = $this->cancelPreparedParcel($object_ip, $ret[0]['parcel_id'], $api_key, $api_url);
				//}
				//else
				//{
					//$reply = $this->cancelPreparedParcel($object_ip, $ret[0]['parcel_id'], $api_key, $api_url);
					//$reply = $this->cancelStickeredParcel($object_ip, $ret[0]['parcel_id'], $ret[0]['variables'], $api_key, $api_url);
				//}

				if($reply['info']['http_code'] == '204')
				{
					// Nothing went wrong. Update status
					$this->model_module_inpost->setParcelToCancelled($order_id);
				}
				else
				{
					//$this->error['warning'] = 
					$this->session->data['success'] = 
						"Failed to cancell the parcel. Error code: " .
						$reply['info']['http_code'];
					if (isset($this->error['warning']))
					{
						$this->data['error_warning'] = $this->error['warning'];
					}
					else
					{
						$this->data['error_warning'] = '';
					}
				}
			}

			//$this->template = 'sale/parcel_list.tpl';
			//$this->children = array(
				//'common/header',
				//'common/footer'
			//);

			//$this->response->setOutput($this->render());
		}

		//$this->getList();

		$this->redirect($this->url->link('sale/inpost_parcel', 'token=' . $this->session->data['token'] . $url, 'SSL'));
	}

	///
	// cancelPreparedParcel function
	//
	// @brief Cancel a parcel which has not had stickers printed.
	//
	private function cancelPreparedParcel($object_ip, $parcel_id, $api_key, $api_url)
	{
		$params['url']        = $api_url . 'parcels/' .
				$parcel_id .
				'/cancel-prepared';
		$params['token']      = $api_key;
		$params['methodType'] = 'POST';
		$params['params']     = array();

		$reply = $object_ip->connectInpostparcels($params);

		$this->log->write('Reply = ' . json_encode($reply));

		return $reply;
	}

	///
	// cancelPreparedParcel function
	//
	// @brief Change the status of a parcel with created stickers.
	//
	// This would not work but the above cancel worksfor either a created
	// parcel or one with stickers created.
	//
	private function cancelStickeredParcel($object_ip, $parcel_id, $vars, $api_key, $api_url)
	{
		$var_data = explode(':', $vars);

		$params['url']        = $api_url . 'parcels/' .
				$parcel_id;
		$params['token']      = $api_key;
		$params['methodType'] = 'PUT';
		$params['params']     = array(
				'description' => 'Cancelled',
				'id'          => $parcel_id,
				'size'        => $var_data[1],
				'status'      => 'Cancelled'
		);
		//$params['id']     = $ret[0]['parcel_id'];
		//$params['size']       = $var_data[1];
		//$params['status']     = 'Cancelled';

		$reply = $object_ip->connectInpostparcels($params);

		$this->log->write('Reply = ' . json_encode($reply));

		return $reply;
	}

	///
	// info function
	//
	// @brief Display the details of the Parcel
	//
	public function info()
	{
		$this->load->model('module/inpost');

		if (isset($this->request->get['order_id']))
		{
			$order_id = $this->request->get['order_id'];
		}
		else
		{
			$order_id = 0;
		}

		$order_info = $this->model_module_inpost->getParcel($order_id);

		if ($order_info)
		{
			$this->load->language('module/inpost');

			$this->document->setTitle($this->language->get('heading_title'));

			$this->data['heading_title'] = $this->language->get('heading_title');

			$text_strings = array(
				'text_order_id',
				'text_parcel_id',
				'text_email',
				'text_parcel_status',
				'text_parcel_detail',
				'text_parcel_machine',
				'text_mobile',
				'text_size',
				'text_creation_date',
				'button_cancel',
			);	

			foreach ($text_strings as $text)
			{
				$this->data[$text] = $this->language->get($text);
			}
			//END LANGUAGE

			$this->data['token'] = $this->session->data['token'];

			$url = '';

			if (isset($this->request->get['filter_order_id'])) {
				$url .= '&filter_order_id=' . $this->request->get['filter_order_id'];
			}
			
			if (isset($this->request->get['filter_customer'])) {
				$url .= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
			}
												
			if (isset($this->request->get['filter_order_status_id'])) {
				$url .= '&filter_order_status_id=' . $this->request->get['filter_order_status_id'];
			}
			
			if (isset($this->request->get['filter_total'])) {
				$url .= '&filter_total=' . $this->request->get['filter_total'];
			}
						
			if (isset($this->request->get['filter_date_added'])) {
				$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
			}
			
			if (isset($this->request->get['filter_date_modified'])) {
				$url .= '&filter_date_modified=' . $this->request->get['filter_date_modified'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->data['breadcrumbs'] = array();

			$this->data['breadcrumbs'][] = array(
				'text'      => $this->language->get('text_home'),
				'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
				'separator' => false
			);

			$this->data['breadcrumbs'][] = array(
				'text'      => $this->language->get('heading_title'),
				'href'      => $this->url->link('sale/order', 'token=' . $this->session->data['token'] . $url, 'SSL'),				
				'separator' => ' :: '
			);

			$this->data['cancel'] = $this->url->link('sale/inpost_parcel', 'token=' . $this->session->data['token'] . $url, 'SSL');

			$this->data['order_id'] = $this->request->get['order_id'];
			
			$this->data['email']          = $order_info['email'];
			$this->data['parcel_id']      = $order_info['parcel_id'];
			$this->data['parcel_status']  = $order_info['parcel_status'];
			$this->data['parcel_details'] = $order_info['parcel_detail'];
			$this->data['parcel_machine'] = $order_info['parcel_machine'];
			
			$this->data['mobile']         = $order_info['mobile'];
			$this->data['size']           = $order_info['size'];
			$this->data['email']          = $order_info['email'];
			$this->data['creation_date'] = date($this->language->get('date_format_short'), strtotime($order_info['creation_date']));
			$this->data['creation_time'] = date($this->language->get('time_format'), strtotime($order_info['creation_date']));

			$this->template = 'sale/parcel_info.tpl';
			$this->children = array(
				'common/header',
				'common/footer'
			);
			
			$this->response->setOutput($this->render());
		}
		else
		{
			$this->load->language('error/not_found');

			$this->document->setTitle($this->language->get('heading_title'));

			$this->data['heading_title'] = $this->language->get('heading_title');

			$this->data['text_not_found'] = $this->language->get('text_not_found');

			$this->data['breadcrumbs'] = array();

			$this->data['breadcrumbs'][] = array(
				'text'      => $this->language->get('text_home'),
				'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
				'separator' => false
			);

			$this->data['breadcrumbs'][] = array(
				'text'      => $this->language->get('heading_title'),
				'href'      => $this->url->link('error/not_found', 'token=' . $this->session->data['token'], 'SSL'),
				'separator' => ' :: '
			);
		
			$this->template = 'error/not_found.tpl';
			$this->children = array(
				'common/header',
				'common/footer'
			);
		
			$this->response->setOutput($this->render());
		}	
	}

	///
	// getForm function
	//
	public function getForm() 
	{
		$this->load->model('module/inpost');

		$text_strings = array(
			'heading_title',
			'text_no_results',
			'text_default',
			'text_select',
			'text_none',
			'text_wait',
			'text_order',
			'entry_email',
			'entry_telephone',
			'text_order_id',
			'text_parcel_id',
			'text_email',
			'text_parcel_status',
			'text_parcel_detail',
			'entry_target_machine_id',
			'text_mobile',
			'text_size',
			'text_creation_date',
			'button_save',
			'button_cancel',
		);	

		foreach ($text_strings as $text)
		{
			$this->data[$text] = $this->language->get($text);
		}
		//END LANGUAGE

 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		
 		if (isset($this->error['mobile'])) {
			$this->data['error_mobile'] = $this->error['mobile'];
		} else {
			$this->data['error_mobile'] = '';
		}

 		if (isset($this->error['size'])) {
			$this->data['error_size'] = $this->error['size'];
		} else {
			$this->data['error_size'] = '';
		}
		
 		if (isset($this->error['email'])) {
			$this->data['error_email'] = $this->error['email'];
		} else {
			$this->data['error_email'] = '';
		}
		
 		if (isset($this->error['target_machine_id'])) {
			$this->data['error_target_machine_id'] = $this->error['target_machine_id'];
		} else {
			$this->data['error_target_machine_id'] = '';
		}
						
		$url = '';

		if (isset($this->request->get['filter_order_id'])) {
			$url .= '&filter_order_id=' . $this->request->get['filter_order_id'];
		}
		
		if (isset($this->request->get['filter_order_status_id'])) {
			$url .= '&filter_order_status_id=' . $this->request->get['filter_order_status_id'];
		}

		if (isset($this->request->get['filter_date_added'])) {
			$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
		}
		
		if (isset($this->request->get['filter_date_modified'])) {
			$url .= '&filter_date_modified=' . $this->request->get['filter_date_modified'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
		
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
		);

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('sale/inpost_parcel', 'token=' . $this->session->data['token'] . $url, 'SSL'),				
			'separator' => ' :: '
		);

		$this->data['action'] = $this->url->link('sale/inpost_parcel/update', 'token=' . $this->session->data['token'] . '&order_id=' . $this->request->get['order_id'] . $url, 'SSL');

		$this->data['save'] = $this->url->link('sale/inpost_parcel/update', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['cancel'] = $this->url->link('sale/inpost_parcel', 'token=' . $this->session->data['token'] . $url, 'SSL');

    	if (isset($this->request->get['order_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$order_info = $this->model_module_inpost->getParcel($this->request->get['order_id']);
    	}

		$this->data['token'] = $this->session->data['token'];
		
		if (isset($this->request->get['order_id'])) {
			$this->data['order_id'] = $this->request->get['order_id'];
		} else {
			$this->data['order_id'] = 0;
		}
					
		if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
			$this->data['store_url'] = HTTPS_CATALOG;
		} else {
			$this->data['store_url'] = HTTP_CATALOG;
		}
		
    		if (isset($this->request->post['email'])) {
      			$this->data['email'] = $this->request->post['email'];
    		} elseif (!empty($order_info)) { 
				$this->data['email'] = $order_info['email'];
			} else {
      			$this->data['email'] = '';
    		}

		if (isset($this->request->post['parcel_id']))
		{
      			$this->data['parcel_id'] = $this->request->post['parcel_id'];
		}
		elseif (!empty($order_info))
		{
      			$this->data['parcel_id'] = $order_info['parcel_id'];
		}
		else
		{
      			$this->data['parcel_id'] = '';
		}

    		if (isset($this->request->post['mobile'])) {
      			$this->data['mobile'] = $this->request->post['mobile'];
    		} elseif (!empty($order_info)) { 
				$this->data['mobile'] = $order_info['mobile'];
		} else {
      			$this->data['mobile'] = '';
    		}
		
    		if (isset($this->request->post['size'])) {
      			$this->data['size'] = $this->request->post['size'];
    		} elseif (!empty($order_info)) { 
				$this->data['size'] = $order_info['size'];
		} else {
      			$this->data['size'] = '';
    		}	
		
		if (isset($this->request->post['target_machine_id'])) {
      		$this->data['target_machine_id'] = $this->request->post['target_machine_id'];
    		} elseif (!empty($order_info)) { 
			$this->data['target_machine_id'] = $order_info['parcel_machine'];
		} else {
      			$this->data['target_machine_id'] = '';
    		}
		
		$this->template = 'sale/parcel_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
		
		$this->response->setOutput($this->render());
  	}


}
?>
