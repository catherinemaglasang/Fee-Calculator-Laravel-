 <div class="result" v-attr="hidden: ! taxAndFees.fees;">
	<h1>Result Breakdown</h1>

	<table class="result-table">
		<tbody>
			<tr>
				<th>Fees</th>
			</tr>
			<tr>
				<td>
					<ul>
						<li class="clearfix">
							<ul class="license-fees clearfix">
								<li class="clearfix" v-repeat="taxAndFees.fees | filterBy hidden_fee_values">
									<span>@{{ $key | fee_readable }}</span>
									<span>$<input type="text" disable="true" value="@{{ $value }}"></span>

								</li>
							</ul>
						</li>
					</ul>
				</td>
			</tr>
		</tbody>
	</table>
</div>