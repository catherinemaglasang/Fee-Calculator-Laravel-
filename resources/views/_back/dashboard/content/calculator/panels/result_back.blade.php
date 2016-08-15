<div class="result" v-if="success">
	<h1>Result Breakdown</h1>

	<table class="result-table">
		<tbody>
			<tr>
				<th>Taxes & Fee Details</th>
			</tr>
			<tr>
				<td>
					<div class="partial-total-row clearfix">
						<strong>Total Fees</strong>
						<span>
							$<input type="text" disable="true" value="@{{ result.fees | total | toFixed }}">
							<button class="more" v-on="click: showSub('fees')">More</button>
						</span>
					</div>
					<ul v-if="views.fees">
						<li class="clearfix">
							<span>Emission Fee</span>
							<span>$<input type="text" disable="true" value="@{{ result.fees.EMISSION_FEE | toFixed }}"></span>
						</li>
						<!-- Start Title Fees -->
						<li class="clearfix">
							<span>Title Fees Total</span>
							<span>
								$<input type="text" disable="true" value="@{{ result.fees | subTotal 'TITLE_FEE,DUP_TITLE_FEE' | toFixed }}">
								<button class="more" v-on="click: showSub('title')">More</button>
							</span>
							<ul class="title-fees clearfix" v-if="views.title">
								<li class="clearfix">
									<span>--Title Fee</span>
									<span>$<input type="text" disable="true" value="@{{ result.fees.TITLE_FEE | toFixed }}"></span>
								</li>
								<li class="clearfix">
									<span>--Duplicate Title Fee</span>
									<span>$<input type="text" disable="true" value="@{{ result.fees.DUP_TITLE_FEE | toFixed }}"></span>
								</li>
							</ul>
						</li>
						<!-- End Title Fees -->

						<!-- License Fees-->
						<li class="clearfix">
							<span>License Fees Total</span>
							<span>
								$<input type="text" disable="true" value="@{{ result.fees | subTotal 'REG_FEE,REG_DPS_FEE,AUTOMAT_FEE,LOCAL_FEE,TEMP_TAG_FEE,DIESEL_FEE,YNG_FRMR_FEE' | toFixed }}">
								<button class="more" v-on="click: showSub('license')">More</button>
							</span>
							<ul class="license-fees clearfix" v-if="views.license">
								<li class="clearfix">
									<span>--Registration Fee</span>
									<span>$<input type="text" disable="true" value="@{{ result.fees.REG_FEE | toFixed }}"></span>
								</li>
								<li class="clearfix">
									<span>--Registration DPS Fee</span>
									<span>$<input type="text" disable="true" value="@{{ result.fees.REG_DPS_FEE | toFixed }}"></span>
								</li>
								<li class="clearfix">
									<span>--Automation Fee</span>
									<span>$<input type="text" disable="true" value="@{{ result.fees.AUTOMAT_FEE | toFixed }}"></span>
								</li>
								<li class="clearfix">
									<span>--Local Fee</span>
									<span>$<input type="text" disable="true" value="@{{ result.fees.LOCAL_FEE | toFixed }}"></span>
								</li>
								<li class="clearfix">
									<span>--Temp Tag Fee</span>
									<span>$<input type="text" disable="true" value="@{{ result.fees.TEMP_TAG_FEE | toFixed }}"></span>
								</li>
								<li class="clearfix">
									<span>--Diesel Fee</span>
									<span>$<input type="text" disable="true" value="@{{ result.fees.DIESEL_FEE | toFixed }}"></span>
								</li>
								<li class="clearfix">
									<span>--Young Farmer Fee</span>
									<span>$<input type="text" disable="true" value="@{{ result.fees.YNG_FRMR_FEE | toFixed }}"></span>
								</li>
							</ul>
						</li>
						<!-- End license Fees -->
						<li class="clearfix">
							<span>Farm Ranch Exempt</span>
							<span>$<input type="text" disable="true" value="@{{ result.fees.FARM_RANCH_EXEMPT | toFixed }}"></span>
						</li>
						<li class="clearfix">
							<span>Registration Options</span>
							<span>$<input type="text" disable="true" value="@{{ result.fees.REG_OPTIONS | toFixed }}"></span>
						</li>
						
						<li class="clearfix">
							<span>EMM Surcharge</span>
							<span>$<input type="text" disable="true" value="@{{ result.fees.EMM_SURCHARGE | toFixed }}"></span>
						</li>
						
						<li class="clearfix">
							<span>VIT TAX</span>
							<span>$<input type="text" disable="true" value="@{{ result.fees.VIT_TAX | toFixed }}"></span>
						</li>
						<li class="clearfix">
							<span>Inspection Fee</span>
							<span>$<input type="text" disable="true" value="@{{ result.fees.INSP_FEE | toFixed }}"></span>
						</li>
						<li class="clearfix">
							<span>Plate Fee</span>
							<span>$<input type="text" disable="true" value="@{{ result.fees.PLATE_FEE | toFixed }}"></span>
						</li>
					</ul>
				</td>
			</tr>
			<tr>
				<td>
					<div class="partial-total-row clearfix">
						<strong>Total Tax</strong>
						<span>
							$<input type="text" disable="true" value="@{{ result.tax | total | toFixed}}">
							<button class="more" v-on="click: showSub('taxes')">More</button>
						</span>
					</div>
					<ul v-if="views.taxes">
						<li class="clearfix">
							<span>Sales Tax Rate</span>
							<span>$<input type="text" disable="true" value="@{{ result.tax.SALES_TAX_RATE | toFixed }}"></span>
						</li>
						<li class="clearfix">
							<span>New Residence Tax</span>
							<span>$<input type="text" disable="true" value="@{{ result.tax.NEW_RESID_TAX | toFixed }}"></span>
						</li>
						<li class="clearfix">
							<span>Gift Tax</span>
							<span>$<input type="text" disable="true" value="@{{ result.tax.GIFT_TAX | toFixed }}"></span>
						</li>
						<li class="clearfix">
							<span>Even Trade Tax</span>
							<span>$<input type="text" disable="true" value="@{{ result.tax.EVEN_TRADE_TAX | toFixed }}"></span>
						</li>
					</ul>
				</td>
			</tr>
			<tr>
				<td>
					<div class="partial-total-row clearfix">
						<strong>Total Penalties</strong>
						<span>
							$<input type="text" disable="true" value="@{{ result.penalties | total | toFixed }}">
							<button class="more"  v-on="click: showSub('penalties')">More</button>
						</span>
					</div>
					<ul v-if="views.penalties">
						<li class="clearfix">
							<span>SALES_TAX_LT_PNLTY</span>
							<span>$<input type="text" disable="true" value="@{{ result.penalties.SALES_TAX_LT_PNLTY | toFixed }}"></span>
						</li>
						<li class="clearfix">
							<span>DLR_LT_PNLTY</span>
							<span>$<input type="text" disable="true" value="@{{ result.penalties.DLR_LT_PNLTY | toFixed }}"></span>
						</li>
						<li class="clearfix">
							<span>CASUAL_LT_PNLTY</span>
							<span>$<input type="text" disable="true" value="@{{ result.penalties.CASUAL_LT_PNLTY | toFixed }}"></span>
						</li>
					</ul>
				</td>
			</tr>
		</tbody>
	</table>
</div>