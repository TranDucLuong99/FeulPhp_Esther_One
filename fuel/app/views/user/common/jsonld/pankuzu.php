<?php if (!empty($json_ld)) { ?>
	<script type="application/ld+json">
		{
			"@context": "https://schema.org",
			"@type": "BreadcrumbList",
			"itemListElement": [{
					"@type": "ListItem",
					"position": 1,
					"name": "メンズエステ求人エステワン",
					"item": "<?php echo Uri::base() ?>"
				}, <?php $_max = count($json_ld); ?><?php $_cnt = 1; ?><?php foreach ($json_ld as $k => $v) { ?> {
					"@type": "ListItem",
					"position": <?php echo ($_cnt + 1) ?>,
					"name": "<?php echo $v['name']; ?>",
					"item": "<?php echo $v['url'] ?>"
				}
				<?php echo ($_cnt++ < $_max) ? ',' : '' ?><?php } ?>

			]
		}
	</script>
<?php } ?>