<div class="result module" v-if="success">
	<h1><i class="fa fa-cogs"></i>&nbsp;Result Breakdown</h1>

	<table class="result-table">
		<tbody>
			<tr>
				<th>Taxes & Fee Details</th>
			</tr>
			<tr>
				<td>
					<!-- Start Title Fees -->
					<div class="partial-total-row clearfix" v-if="transactionType != 5">
						<strong>Title Fees</strong>
						<span>
							$<input type="text" disabled="true" value="@{{ result.fees | subTotal sums.title_fees | toFixed }}" v-model="title_fees">
							<button class="more" v-on="click: showSub('title_fees')">More</button>
						</span>
					</div>
					<ul v-if="views.title_fees">
						<li class="clearfix">
							<span>--Title Fee</span>
							<span>$<input type="text" disabled="true" value="@{{ result.fees.TITLE_FEE | toFixed }}"></span>
						</li>
						<li class="clearfix" v-if="transactionType != 2 && transactionType != 4 && transactionType != 6">
							<span>--Duplicate Title Fee</span>
							<span>$<input type="text" disabled="true" value="@{{ result.fees.DUP_TITLE_FEE | toFixed }}"></span>
						</li>
					</ul>
					<!-- End Title Fees -->
					<!-- Start License Fees -->
					<div class="partial-total-row clearfix" v-if="transactionType != 3 && transactionType != 6">
						<strong>License Fees</strong>
						<span>
							$<input type="text" disabled="true" value="@{{ result.fees | subTotal sums.license_fees | toFixed }}" v-model="license_fees">
							<button class="more" v-on="click: showSub('license')">More</button>
						</span>
					</div>
					<ul class="license-fees clearfix" v-if="views.license">
						<li class="clearfix" v-if="transactionType != 2 && transactionType != 4">
							<span>--Registration Fee</span>
							<span>$<input type="text" disabled="true" value="@{{ result.fees.REG_FEE | toFixed }}"></span>
						</li>
						<li class="clearfix" v-if="transactionType != 2 && transactionType != 4">
							<span>--Automation Fee</span>
							<span>$<input type="text" disabled="true" value="@{{ result.fees.AUTOMAT_FEE | toFixed }}"></span>
						</li>
						<li class="clearfix" v-if="transactionType != 2 && transactionType != 4">
							<span>--Registration DPS Fee</span>
							<span>$<input type="text" disabled="true" value="@{{ result.fees.REG_DPS_FEE | toFixed }}"></span>
						</li>
						<li class="clearfix" v-if="transactionType != 2 && transactionType != 4">
							<span>--Local Fee</span>
							<span>$<input type="text" disabled="true" value="@{{ result.fees.LOCAL_FEE | toFixed }}"></span>
						</li>
						<li class="clearfix" v-if="temp_tag">
							<span>--Temp Tag Fee</span>
							<span>$<input type="text" disabled="true" value="@{{ result.fees.TEMP_TAG_FEE | toFixed }}"></span>
						</li>
						<li class="clearfix" v-if="transactionType != 4">
							<span>--Diesel Fee</span>
							<span>$<input type="text" disabled="true" value="@{{ result.fees.DIESEL_FEE | toFixed }}"></span>
						</li>
						<li class="clearfix">
							<span>--Registration Inspection Fee</span>
							<span>$<input type="text" disabled="true" value="@{{ result.fees.INSP_FEE | toFixed }}"></span>
						</li>
						<li class="clearfix" v-if="transactionType != 4 && farm_or_ranch">
							<span>--Young Farmer Fee</span>
							<span>$<input type="text" disabled="true" value="@{{ result.fees.YNG_FRMR_FEE | toFixed }}"></span>
						</li>
					</ul>
					<!-- End License Fees -->
					<!-- Start Inspection Fees -->
					<div class="partial-total-row clearfix" v-if="transactionType != 3 && transactionType != 6">
						<strong>Inspection Fees</strong>
						<span>
							$<input type="text" disabled="true" value="@{{ result.fees | subTotal sums.inspection_fees | toFixed }}" v-model="inspection_fees">
							<button class="more" v-on="click: showSub('inspection')">More</button>
						</span>
					</div>
					<ul class="license-fees clearfix" v-if="views.inspection">
						<li class="clearfix">
							<span>--Inspection Fee</span>
							<span>$<input type="text" disabled="true" value="@{{ result.fees.INSP_FEE | toFixed }}"></span>
						</li>
					</ul>
					<!-- End Inspection Fees -->
					<!-- Start Other Fees -->
					<div class="partial-total-row clearfix" v-if="transactionType != 3 && transactionType != 6">
						<strong>Other Fees</strong>
						<span>
							$<input type="text" disabled="true" value="@{{ result.penalties | subTotal sums.other_fees |toFixed }}" v-model="other_fees">
							<button class="more" v-on="click: showSub('other')">More</button>
						</span>
					</div>
					<ul class="license-fees clearfix" v-if="views.other">
						<li class="clearfix">
							<span>--Miscallaneous Fees</span>
							<span>$<input type="text" disabled="true" value="TBA"></span>
						</li>
						<li class="clearfix" v-if="transactionType != 4">
							<span>--Rebuilt Salvage Fee</span>
							<span>$<input type="text" disabled="true" value="TBA"></span>
						</li>
						<li class="clearfix">
							<span>--Deputy Fee</span>
							<span>$<input type="text" disabled="true" value="TBA"></span>
						</li>
						<li class="clearfix">
							<span>--Dealer Late Penalty</span>
							<span>$<input type="text" disabled="true" value="@{{ result.penalties.DLR_LT_PNLTY | toFixed }}"></span>
						</li>
						<li class="clearfix">
							<span>--Individual Late Penalty</span>
							<span>$<input type="text" disabled="true" value="@{{ result.penalties.CASUAL_LT_PNLTY | toFixed }}"></span>
						</li>
					</ul>
					<!-- End other Fees -->
					<!-- Start sales Tax -->
					<div class="partial-total-row clearfix" v-if="transactionType != 3 && transactionType != 6">
						<strong>Sales Tax</strong>
						<span>
							$<input type="text" disabled="true" value="@{{ result | mixTotal sums.sales_tax | toFixed }}" v-model="sales_tax">
							<button class="more" v-on="click: showSub('sales_tax')">More</button>
						</span>
					</div>
					<ul class="license-fees clearfix" v-if="views.sales_tax">
						<li class="clearfix">
							<span>
								<select name="" v-model="defaultTax" v-on="change: getCatAndType()">
									<option value="SALES_TAX_RATE">Texas Sales/Use Tax $@{{ result.tax.SALES_TAX_RATE | toFixed}}</option>
									<option value="EVEN_TRADE_TAX">Even Trade Tax $@{{ result.tax.EVEN_TRADE_TAX | toFixed}}</option>
									<option value="GIFT_TAX">Gift Tax $@{{ result.tax.GIFT_TAX | toFixed}}</option>
									<option value="NEW_RESID_TAX">Non-Residence Tax $@{{ result.tax.NEW_RESID_TAX | toFixed}}</option>
								</select>
							</span>
							<span>$<input type="text" disabled="true" value="@{{ selectedTax | toFixed }}"></span>
						</li>
						<!-- <li class="clearfix">
							<span>--Sales Tax Rate</span>
							<span>$<input type="text" disable="true" value="@{{ result.tax.SALES_TAX_RATE | toFixed }}"></span>
						</li>
						<li class="clearfix">
							<span>--New Residence Tax</span>
							<span>$<input type="text" disable="true" value="@{{ result.tax.NEW_RESID_TAX | toFixed }}"></span>
						</li>
						<li class="clearfix">
							<span>--Gift Tax</span>
							<span>$<input type="text" disable="true" value="@{{ result.tax.GIFT_TAX | toFixed }}"></span>
						</li>
						<li class="clearfix">
							<span>--Even Trade Tax</span>
							<span>$<input type="text" disable="true" value="@{{ result.tax.EVEN_TRADE_TAX | toFixed }}"></span>
						</li> -->
						<li class="clearfix">
							<span>--Sales Tax Late Penalty</span>
							<span>$<input type="text" disabled="true" value="@{{ result.tax.SALES_TAX_LT_PNLTY | toFixed }}"></span>
						</li>
						<li class="clearfix" v-if="transactionType != 4">
							<span>--Emission Fee</span>
							<span>$<input type="text" disabled="true" value="@{{ result.fees.EMISSION_FEE | toFixed }}"></span>
						</li>
						<li class="clearfix" v-if="transactionType != 4">
							<span>--Emissions Surcharge</span>
							<span>$<input type="text" disabled="true" value="@{{ result.fees.EMM_SURCHARGE | toFixed }}"></span>
						</li>
					</ul>
					<!-- End sales Tax -->
					<div class="partial-total-row clearfix" v-if="transactionType != 3 && transactionType != 6">
						<strong>Property Tax</strong>
						<span>
							$<input type="text" disabled="true" value="@{{ result.fees | subTotal sums.property_tax | toFixed }}" v-model="property_tax">
							<button class="more" v-on="click: showSub('property_tax')">More</button>
						</span>
					</div>
					<ul class="license-fees clearfix" v-if="views.property_tax">
						<li class="clearfix">
							<span>--Dealer Inventory Tax</span>
							<span>$<input type="text" disabled="true" value="@{{ result.tax.VIT_TAX | toFixed }}"></span>
						</li>
					</ul>
					<div class="partial-total-row clearfix">
						<strong>Total Fees</strong>
						<span>
							$<input type="text" disabled="true" value="@{{ total_fees | toFixed }}">
						</span>
					</div>
					<div class="partial-total-row clearfix">
						<strong>Total Tax</strong>
						<span>
							$<input type="text" disabled="true" value="@{{ total_tax | toFixed }}">
						</span>
					</div>
					<div class="partial-total-row clearfix">
						<strong>Total Penalties</strong>
						<span>
							$<input type="text" disabled="true" value="@{{ total_penalties | toFixed }}">
						</span>
					</div>
				</td>
			</tr>
		</tbody>
	</table>
</div>