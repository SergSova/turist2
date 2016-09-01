<?php
    use yii\web\JsExpression;
    use yii2fullcalendar\yii2fullcalendar;

    /** @var \yii2fullcalendar\models\Event[] $calEvents */

?>
<div class="panel-default" style="position:absolute; display: none; z-index: 1000; transform: translateX(-50%);min-width: 300px; background: white;"
     id="eventPopup">
    <div class="panel-heading " id="eventHeading"></div>
    <div class="panel-body" id="eventBody"></div>
    <div class="panel-footer">
        <a href="" class="btn btn-primary" id="buttonRedirect">Open</a>
    </div>
</div>

<?= yii2fullcalendar::widget([
                                 'events'        => $events,
                                 'options'       => [
                                     'id'   => 'calendar',
                                     'lang' => 'ru',
                                 ],
                                 'clientOptions' => [
                                     'eventClick' => new JsExpression('function(calEvent, jsEvent, view) {
                                    jsEvent.preventDefault();
var eventTitle = $("#eventHeading");
var eventBody = $("#eventBody");
var buttonRedirect = $("#buttonRedirect");
var eventPopup = $("#eventPopup");

eventTitle.text(calEvent.title);
eventBody.text(calEvent.description);
buttonRedirect.attr("href", calEvent.url);
eventPopup.css({
    background: calEvent.backgroundColor?calEvent.backgroundColor:"white",
    display: "block",
    top: (parseInt(jsEvent.pageY) - $(window).scrollTop()) + "px",
    left: jsEvent.pageX
});
}')
                                 ]

                             ]); ?>


