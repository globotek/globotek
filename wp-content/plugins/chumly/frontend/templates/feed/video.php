This is a video post format type.

<!-- DEFAULT NEWS FEED ITEM WITH MEDIA (VIDEO) -->
<li class="news-feed__item">
	<div class="news-feed__item__inner">
		<div class="news-feed__item__decor">
			<svg class="button__icon button__icon--right icon" aria-hidden="true">
				<use xmlns:xlink="http://www.w3.org/1999/xlink"
				     xlink:href="<?php /*echo $chumly->plugin_uri . '/frontend/images/icons/svg-symbols.svg#video'; */?>"></use>
			</svg>
		</div>
		<div class="news-feed__item__detail">
			<h3 class="news-feed__item__heading">
				<a href="#">Person Mc Very Long Name</a> posted a <a href="#">video</a>
			</h3>
			<div class="news-feed__media">
				<div class="news-feed__item__media" aria-hidden="true">
					<!-- make sure you add the component class to embed iframes -->
					<iframe class="news-feed__item__embed" width="560" height="315"
					        src="https://www.youtube.com/embed/KRCKS5CI6dM" frameborder="0"
					        allowfullscreen></iframe>
				</div>
			</div>
			<div class="news-feed__item__content">
				<div class="wysiwyg">
					<p>Morbi id placerat arcu. Pellentesque egestas, justo in efficitur tristique, ex diam
						sagittis ante.</p>
				</div>
			</div>
			<a href="#" class="comments__item__reply">More</a>
		</div>
	</div>
</li>
<!-- DEFAULT NEWS FEED ITEM WITH MEDIA (VIDEO) -->
