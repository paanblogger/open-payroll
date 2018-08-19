<?php

if (! function_exists('payroll')) {
    function payroll($identifier)
    {
        return \App\Processors\PayrollProcessor::make($identifier);
    }
}

if (! function_exists('payslip')) {
    function payslip($identifier)
    {
        return \App\Processors\PayslipProcessor::make($identifier);
    }
}
