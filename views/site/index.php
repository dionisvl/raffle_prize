<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Hello!</h1>

        <p class="lead">You can get your prize here!</p>

        <p>
            <button data-toggle="modal" data-target="#prize_modal" class="btn btn-lg btn-success">Give me prize</button>
        </p>

        <?php
        $js = <<<JS
   $(document).on('click', "button[data-toggle='modal']", function () {
        console.log(10);
        $(this).find('.modal-body').load("/prizes .prize_block"); 
        $(this.dataset.target).find('.modal-body').html(123333); 
    }); 
JS;

        $this->registerJs($js);
        ?>

        <div class="modal fade snta-modal" id="prize_modal" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Your prize:</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        0
                    </div>
                </div>
            </div>
        </div>


    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Money</h2>

                <p>Money...</p>

                <p><a class="btn btn-default" href="">...</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Bonus points</h2>

                <p>Bonus points</p>

                <p><a class="btn btn-default" href="">...</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Material priz</h2>

                <p>Material prize</p>

                <p><a class="btn btn-default" href="">...</a></p>
            </div>
        </div>

    </div>
</div>
