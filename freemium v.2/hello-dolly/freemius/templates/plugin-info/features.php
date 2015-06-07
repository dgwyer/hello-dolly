<?php
	$plans = $VARS['plans'];

	$features_plan_map = array();
	foreach ($plans as $plan)
	{
		foreach ($plan->features as $feature)
		{
			if (!isset($features_plan_map[$feature->id]))
				$features_plan_map[$feature->id] = array('feature' => $feature, 'plans' => array());

			$features_plan_map[$feature->id]['plans'][$plan->id] = $feature;
		}
	}
?>
	<div class="fs-features">
		<table>
			<thead>
				<tr>
					<th></th>
					<?php foreach ($plans as $plan) : ?>
					<th>
						<?php echo $plan->title ?>
						<span class="fs-price">
						<?php foreach ($plan->pricing as $pricing ) : ?>
							<?php if (1 == $pricing->licenses) : ?>
								$<?php echo $pricing->annual_price ?> / year
							<?php endif ?>
						<?php endforeach ?>
						</span>
					</th>
					<?php endforeach ?>
				</tr>
			</thead>
			<tbody>
			<?php $odd = true; foreach ($features_plan_map as $feature_id => $data) : ?>
				<tr class="fs-<?php echo $odd ? 'odd' : 'even' ?>">
				<td><?php echo ucfirst($data['feature']->title) ?></td>
				<?php foreach ($plans as $plan) : ?>
					<td>
						<?php if (isset($data['plans'][$plan->id])) : ?>
							<?php if (!empty($data['plans'][$plan->id]->value)) : ?>
								<b><?php echo $data['plans'][$plan->id]->value ?></b>
							<?php else : ?>
								<i class="dashicons dashicons-yes"></i>
							<?php endif ?>
						<?php endif ?>
					</td>
				<?php endforeach ?>
				</tr>
			<?php $odd = !$odd; endforeach ?>
			</tbody>
		</table>
	</div>