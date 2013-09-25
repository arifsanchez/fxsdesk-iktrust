<?php 
    #debug($var); die();
    echo $this->element('popup.feature.comingsoon');
    echo $this->element('popup.DPmaybank', array('bal' => $acc1['Vault']['acc_1'], 'uid' => $var['User']['id']));
?>

<div class="row-fluid">
    <div class="span4">
        <div class="box box-small box-bordered box-color blue">
            <div class="box-title">
                <h3>
                    Barclays
                </h3>
                <div class="actions">
                    <a href="#popup-coming-soon" data-toggle="modal"  class="btn" rel="tooltip" title="Deposit via Barclays Bank"><i class="glyphicon-bank"></i> Submit Deposit</a>
                </div>
            </div>
            <div class="box-content">
                <img src="<?php echo SITE_URL;?>img/payment_channel/barclays150x150.jpg" alt="Barclays Bank" class="pull-left" style='margin-right:10px'>
                <dl>
                    <dt>Currencies</dt>
                    <dd>
                        EUR,USD,GBP
                    </dd>
                    <dt>Country</dt>
                    <dd>
                        All countries
                    </dd>
                    <dt>Processing Time</dt>
                    <dd>
                        1-5 Business Days
                    </dd>
                </dl>

            </div>
        </div>
    </div>
    <div class="span4">
        <div class="box box-small box-bordered box-color blue">
            <div class="box-title">
                <h3>
                    BMI Bank
                </h3>
                <div class="actions">
                    <a href="#popup-coming-soon" data-toggle="modal" class="btn" rel="tooltip" title="Deposit via BMI Bank"><i class="glyphicon-bank"></i> Submit Deposit</a>
                </div>
            </div>
            <div class="box-content">
                <img src="<?php echo SITE_URL;?>img/payment_channel/bmi_bank150x150.jpg" alt="BMI Bank" class="pull-left" style='margin-right:10px'>
                <dl>
                    <dt>Currencies</dt>
                    <dd>
                        EUR,USD,GBP
                    </dd>
                    <dt>Country</dt>
                    <dd>
                        All countries
                    </dd>
                    <dt>Processing Time</dt>
                    <dd>
                        1-5 Business Days
                    </dd>
                </dl>

            </div>
        </div>
    </div>
    <div class="span4">
        <div class="box box-small box-bordered box-color blue">
            <div class="box-title">
                <h3>
                    GTS
                </h3>
                <div class="actions">
                    <a href="#popup-coming-soon" data-toggle="modal" class="btn" rel="tooltip" title="Deposit via GTS"><i class="glyphicon-bank"></i> Submit Deposit</a>
                </div>
            </div>
            <div class="box-content">
                <img src="<?php echo SITE_URL;?>img/payment_channel/gts150x150.png" alt="GTS" class="pull-left" style='margin-right:10px'>
                <dl>
                    <dt>Currencies</dt>
                    <dd>
                        EUR,USD,GBP
                    </dd>
                    <dt>Country</dt>
                    <dd>
                        All countries
                    </dd>
                    <dt>Processing Time</dt>
                    <dd>
                        1-5 Business Days
                    </dd>
                </dl>
            </div>
        </div>
    </div>
</div>

<div class="row-fluid">
    <div class="span4">
        <div class="box box-small box-bordered box-color brown">
            <div class="box-title">
                <h3>
                    Bank Central Asia
                </h3>
                <div class="actions">
                    <a href="#popup-coming-soon" data-toggle="modal" class="btn" rel="tooltip" title="Deposit via Bank Central Asia"><i class="glyphicon-bank"></i> Submit Deposit</a>
                </div>
            </div>
            <div class="box-content">
                <img src="<?php echo SITE_URL;?>img/payment_channel/bca150x150.png" alt="BCA" class="pull-left" style='margin-right:10px'>
                <dl>
                    <dt>Currencies</dt>
                    <dd>
                        IDR
                    </dd>
                    <dt>Country</dt>
                    <dd>
                        Indonesia
                    </dd>
                    <dt>Processing Time</dt>
                    <dd>
                        1-2 Business Days
                    </dd>
                </dl>
            </div>
        </div>
    </div>
    <div class="span4">
        <div class="box box-small box-bordered box-color brown">
            <div class="box-title">
                <h3>
                    Mandiri Bank
                </h3>
                <div class="actions">
                    <a href="#popup-coming-soon" data-toggle="modal" class="btn" rel="tooltip" title="Deposit via Mandiri Bank"><i class="glyphicon-bank"></i> Submit Deposit</a>
                </div>
            </div>
            <div class="box-content">
                <img src="<?php echo SITE_URL;?>img/payment_channel/mandiri150x150.jpg" alt="Mandiri" class="pull-left" style='margin-right:10px'>
                <dl>
                    <dt>Currencies</dt>
                    <dd>
                        IDR
                    </dd>
                    <dt>Country</dt>
                    <dd>
                        Indonesia
                    </dd>
                    <dt>Processing Time</dt>
                    <dd>
                        1-2 Business Days
                    </dd>
                </dl>
            </div>
        </div>
    </div>
    <div class="span4">
        <div class="box box-small box-bordered box-color brown">
            <div class="box-title">
                <h3>
                    CIMB Niaga
                </h3>
                <div class="actions">
                    <a href="#popup-coming-soon" data-toggle="modal" class="btn" rel="tooltip" title="Deposit via CIMB Niaga"><i class="glyphicon-bank"></i> Submit Deposit</a>
                </div>
            </div>
            <div class="box-content">
                <img src="<?php echo SITE_URL;?>img/payment_channel/cimbniaga150x150.png" alt="Mandiri" class="pull-left" style='margin-right:10px'>
                <dl>
                    <dt>Currencies</dt>
                    <dd>
                        IDR
                    </dd>
                    <dt>Country</dt>
                    <dd>
                        Indonesia
                    </dd>
                    <dt>Processing Time</dt>
                    <dd>
                        1-2 Business Days
                    </dd>
                </dl>
            </div>
        </div>
    </div>
</div>

<div class="row-fluid">
    <div class="span4">
        <div class="box box-small box-bordered box-color lightred">
            <div class="box-title">
                <h3>
                    Maybank
                </h3>
                <div class="actions">
                    <a href="#DPmaybank-<?php echo $var['User']['id'];?>" data-toggle="modal" class="btn" rel="tooltip" title="Deposit via Maybank"><i class="glyphicon-bank"></i> Submit Deposit</a>
                </div>
            </div>
            <div class="box-content">
                <img src="<?php echo SITE_URL;?>img/payment_channel/maybank150x150.jpg" alt="Maybank" class="pull-left" style='margin-right:10px'>
                <dl>
                    <dt>Currencies</dt>
                    <dd>
                        MYR
                    </dd>
                    <dt>Country</dt>
                    <dd>
                        Malaysia
                    </dd>
                    <dt>Processing Time</dt>
                    <dd>
                        1-2 Business Days
                    </dd>
                </dl>
            </div>
        </div>
    </div>
    <div class="span4">
        <div class="box box-small box-bordered box-color lightred">
            <div class="box-title">
                <h3>
                    CIMB Bank
                </h3>
                <div class="actions">
                    <a href="#popup-coming-soon" data-toggle="modal" class="btn" rel="tooltip" title="Deposit via CIMB Bank"><i class="glyphicon-bank"></i> Submit Deposit</a>
                </div>
            </div>
            <div class="box-content">
                <img src="<?php echo SITE_URL;?>img/payment_channel/cimbbank150x150.png" alt="GTS" class="pull-left" style='margin-right:10px'>
                <dl>
                    <dt>Currencies</dt>
                    <dd>
                        MYR
                    </dd>
                    <dt>Country</dt>
                    <dd>
                        Malaysia
                    </dd>
                    <dt>Processing Time</dt>
                    <dd>
                        1-2 Business Days
                    </dd>
                </dl>
            </div>
        </div>
    </div>
    <div class="span4">
        <div class="box box-small box-bordered box-color lightred">
            <div class="box-title">
                <h3>
                    Public Bank
                </h3>
                <div class="actions">
                    <a href="#popup-coming-soon" data-toggle="modal" class="btn" rel="tooltip" title="Deposit via Public Bank"><i class="glyphicon-bank"></i> Submit Deposit</a>
                </div>
            </div>
            <div class="box-content">
                <img src="<?php echo SITE_URL;?>img/payment_channel/pbe150x150.png" alt="GTS" class="pull-left" style='margin-right:10px'>
                <dl>
                    <dt>Currencies</dt>
                    <dd>
                        MYR
                    </dd>
                    <dt>Country</dt>
                    <dd>
                        Malaysia
                    </dd>
                    <dt>Processing Time</dt>
                    <dd>
                        1-2 Business Days
                    </dd>
                </dl>
            </div>
        </div>
    </div>
</div>