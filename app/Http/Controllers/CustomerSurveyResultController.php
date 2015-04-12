<?php namespace Survey\Http\Controllers;

use Survey\Http\Requests;
use Survey\Http\Controllers\Controller;
use Survey\Customer;
use Survey\Survey;
use Survey\Result;
use Illuminate\Http\Request;

class CustomerSurveyResultController extends Controller {

    /**
     * Instantiate a new Controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('customerplus');
        $this->middleware('resultPerms');
    }

    /**
     * Show the result using the standard template.
     * @param Customer $customer
     * @param Survey $survey
     * @param Result $result
     * @return mixed
     */
    public function standard(Customer $customer, Survey $survey, Result $result)
    {
        dd($result->data);
        return view('result.standard')->withSurvey($survey)->withCustomer($customer)->withResult($result);
    }

    /**
     * Show the result using the excel template.
     * @param Customer $customer
     * @param Survey $survey
     * @param Result $result
     * @return mixed
     */
    public function excel(Customer $customer, Survey $survey, Result $result)
    {
        return view('result.excel')->withSurvey($survey)->withCustomer($customer)->withResult($result);
    }

}
