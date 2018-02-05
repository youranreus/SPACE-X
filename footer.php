<?php $this->footer(); ?>

</div>
</div>
	</body>
  <footer>
		<div class="footer">
			<p>©<?php $this->options->title(); ?> 2017<br>托管于 HXKVM. 又拍云 七牛等没有提供静态文件云存储服务. 人肉估测网站统计服务. DNSPOD 提供 DNS 解析服务.<br><SPAN id=span_dt_dt></SPAN><?php if ($this->options->BANumber): ?><br><?php $this->options->BANumber(); ?><?php endif; ?><br>Made with love by YOURAN.</p>
		</div>
		<script src="<?php $this->options->themeUrl('js/space.js'); ?>"></script>
		<script src="<?php $this->options->themeUrl('js/classie.js'); ?>"></script>
		<script src="<?php $this->options->themeUrl('js/menu.js'); ?>"></script>
		<script src="<?php $this->options->themeUrl('js/prism.js'); ?>"></script>
		<script>
		var new_scroll_position = 0;
		var last_scroll_position;
		var header = document.getElementById("nav");

		window.addEventListener('scroll', function(e) {
				last_scroll_position = window.scrollY;

				if (new_scroll_position < last_scroll_position && last_scroll_position > 80) {
  				header.classList.remove("slideDown");
  				header.classList.add("slideUp");

				} else if (new_scroll_position > last_scroll_position) {
  			header.classList.remove("slideUp");
  		header.classList.add("slideDown");
		}

		new_scroll_position = last_scroll_position;
	});
		</script>

	</footer>
</html>
