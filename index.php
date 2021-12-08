<!-- dit is het bestand dat wordt geladen zodra je naar de website gaat -->
<?php
include __DIR__ . "/header.php";
?>
<div id="myModal" class="modal fade">
	<div class="modal-dialog modal-confirm">
		<div class="modal-content">
			<div class="modal-header justify-content-center">
				<div class="icon-box">
                    <i class="fas fa-check"></i>
				</div>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<div class="modal-body text-center">
				<h4>Uw bestelling is geplaatst!</h4>
				<p>Wij zullen zo snel mogelijk beginnen met uw bestelling!</p>
				<button class="btn btn-success" data-dismiss="modal"><span>Doorgaan</span></button>
			</div>
		</div>
	</div>
</div>
<div class="IndexStyle">
    <div class="col-11">
        <div class="TextPrice">
            <a href="view.php?id=93">
                <div class="TextMain">
                    "The Gu" red shirt XML tag t-shirt (Black) M
                </div>
                <ul id="ul-class-price">
                    <li class="HomePagePrice">€30.95</li>
                </ul>
        </div>
        </a>
        <div class="HomePageStockItemPicture"></div>
    </div>
</div>
<?php
include __DIR__ . "/footer.php";
?>

