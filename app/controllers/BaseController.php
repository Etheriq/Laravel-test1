<?php
namespace proj1\Controllers\Base;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class BaseController extends Controller {

    protected $request;

    public function __construct(Request $request) {
        $this->request = $request;
    }

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}
