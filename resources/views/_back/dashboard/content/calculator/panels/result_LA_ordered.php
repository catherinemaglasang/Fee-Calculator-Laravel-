<div class="result" v-if="success">
    <h1>Sales Tax Breakdown</h1>

    <table class="result-table">
        <tbody>
        <tr>
            <th>Taxes & Fee Details</th>
        </tr>
        <tr>
            <td>
                <div class="partial-total-row clearfix">
                    <strong>Title Fees</strong>
						<span>
							$<input type="text" disabled value="{{ taxAndFees.fees | subTotalWithString 'TITLE_FEE,DUP_TITLE_FEE,TITLE_CORRECTION_FEE,MORTGAGE_FEE' | toDollar }}">
                                <button type="button" v-on="click: showSub('titleFees')">More</button>
						</span>
                </div>
                <ul v-if="views.titleFees">
                    <li class="clearfix" v-if="taxAndFees.fees.TITLE_FEE != ''">
                        <span> -- Title Fee</span>
                        <span>$<input type="text" disabled="true" value="{{ taxAndFees.fees.TITLE_FEE | toDollar }}"></span>
                    </li>
                    <li class="clearfix" v-if="taxAndFees.fees.DUP_TITLE_FEE != ''">
                        <span>-- Duplicate Title Fee</span>
                        <span>$<input type="text" disabled="true" value="{{ taxAndFees.fees.DUP_TITLE_FEE | toDollar }}"></span>
                    </li>
                    <li class="clearfix" v-if="taxAndFees.fees.TITLE_CORRECTION_FEE != ''">
                        <span>-- Title Correction Fee</span>
                        <span>$<input type="text" disabled="true" value="{{ taxAndFees.fees.TITLE_CORRECTION_FEE | toDollar }}"></span>
                    </li>
                    <li class="clearfix" v-if="taxAndFees.fees.MORTGAGE_FEE != ''">
                        <span> -- Mortgage Fee</span>
                        <span>$<input type="text" disabled="true" value="{{ taxAndFees.fees.MORTGAGE_FEE }}"></span>
                    </li>
                </ul>
                <div class="partial-total-row clearfix">
                    <strong>License Fees</strong>
						<span>
							$<input type="text" disabled value="{{ taxAndFees.fees | subTotalWithString 'LICENSE_FEE,LICENSE_PNLTY_FEE,LICENSE_TRNSFR_FEE' | toDollar }}">
                                <button class="more" v-on="click: showSub('licenseFees')">More</button>
						</span>
                </div>
                <ul v-if="views.licenseFees">
                    <li class="clearfix" v-if="taxAndFees.fees.LICENSE_FEE != ''">
                        <span> -- License Fee</span>
                        <span>$<input type="text" disabled="true" value="{{ taxAndFees.fees.LICENSE_FEE | toDollar }}"></span>
                    </li>
                    <li class="clearfix" v-if="taxAndFees.fees.LICENSE_PNLTY_FEE != ''">
                        <span> -- License Penalty Fee</span>
                        <span>$<input type="text" disabled="true" value="{{ taxAndFees.fees.LICENSE_PNLTY_FEE | toDollar }}"></span>
                    </li>
                    <li class="clearfix" v-if="taxAndFees.fees.LICENSE_TRNSFR_FEE != ''">
                        <span> -- License Transfer Fee</span>
                        <span>$<input type="text" disabled="true" value="{{ taxAndFees.fees.LICENSE_TRNSFR_FEE | toDollar }}"></span>
                    </li>
                </ul>
                <div class="partial-total-row clearfix">
                    <strong>Other Fees</strong>
						<span>
							$<input type="text" disabled value="{{ taxAndFees.fees | subTotalWithString 'HANDLING_FEE,NOTARY_FEE' | toDollar }}">
                                <button class="more" v-on="click: showSub('otherFees')">More</button>
						</span>
                </div>
                <ul v-if="views.otherFees">
                    <li class="clearfix" v-if="taxAndFees.fees.HANDLING_FEE != ''">
                        <span> -- Handling Fee</span>
                        <span>$<input type="text" disabled="true" value="{{ taxAndFees.fees.HANDLING_FEE | toDollar }}"></span>
                    </li>
                    <li class="clearfix" v-if="taxAndFees.fees.NOTARY_FEE != ''">
                        <span> -- Notary Fee</span>
                        <span>$<input type="text" disabled="true" value="{{ taxAndFees.fees.NOTARY_FEE | toDollar }}"></span>
                    </li>
                </ul>
                <div class="partial-total-row clearfix">
                    <strong>Sales Tax</strong>
						<span>
							$<input type="text" disabled value="{{ taxAndFees.sales_tax | subTotalWithString 'AVALARA_TAX,SALES_TAX_PENALTY,VENDORS_COMP,INTEREST' | toDollar }}">
                                <button class="more" v-on="click: showSub('salesTax')">More</button>
						</span>
                </div>
                <ul v-if="views.salesTax">
                    <li class="clearfix" v-if="taxAndFees.sales_tax.AVALARA_TAX != ''">
                        <span> -- Sales Tax</span>
                        <span>$<input type="text" disabled value="{{ taxAndFees.sales_tax.AVALARA_TAX | toDollar }}"></span>
                    </li>
                    <li class="clearfix" v-if="taxAndFees.sales_tax.SALES_TAX_PENALTY != ''">
                        <span> -- Sales Tax Penalty</span>
                        <span>$<input type="text" disabled value="{{ taxAndFees.sales_tax.SALES_TAX_PENALTY | toDollar }}"></span>
                    </li>
                    <li class="clearfix" v-if="taxAndFees.sales_tax.INTEREST != ''">
                        <span> -- Interest</span>
                        <span>$<input type="text" disabled value="{{ taxAndFees.sales_tax.INTEREST | toDollar }}"></span>
                    </li>
                </ul>
                <div class="partial-total-row clearfix">
                    <strong>Tag Agency Fees</strong>
						<span>
							$<input type="text" disabled value="{{ taxAndFees.fees | subTotalWithString 'CONVENIENCE_FEE,PROCESSING_FEE,MAIL_FEE,VENDORS_COMP_AGENCY' | toDollar }}">
                                <button class="more" v-on="click: showSub('taxAgencyFees')">More</button>
						</span>
                </div>
                <ul v-if="views.taxAgencyFees">
                    <li class="clearfix" v-if="taxAndFees.fees.CONVENIENCE_FEE != ''">
                        <span> -- Convenience Fee</span>
                        <span>$<input type="text" disabled="true" value="{{ taxAndFees.fees.CONVENIENCE_FEE | toDollar }}"></span>
                    </li>
                    <li class="clearfix" v-if="taxAndFees.fees.PROCESSING_FEE != ''">
                        <span> -- Processing Fee</span>
                        <span>$<input type="text" disabled="true" value="{{ taxAndFees.fees.PROCESSING_FEE | toDollar }}"></span>
                    </li>
                    <li class="clearfix" v-if="taxAndFees.fees.MAIL_FEE != ''">
                        <span> -- Mail Fee</span>
                        <span>$<input type="text" disabled="true" value="{{ taxAndFees.fees.MAIL_FEE | toDollar }}"></span>
                    </li>
                    <li class="clearfix" v-if="taxAndFees.fees.VENDORS_COMP_AGENCY != ''">
                        <span> -- Vendor's Comp</span>
                        <span>$<input type="text" disabled value="{{ taxAndFees.fees.VENDORS_COMP_AGENCY | toDollar }}"></span>
                    </li>
                </ul>
                <div class="partial-total-row clearfix">
                    <strong>Total Fees</strong>
						<span>
							$<input type="text" disabled value="{{ taxAndFees.fees | subTotalWithString 'TITLE_FEE,DUP_TITLE_FEE,TITLE_CORRECTION_FEE,MORTGAGE_FEE,LICENSE_FEE,LICENSE_PNLTY_FEE,LICENSE_TRNSFR_FEE,HANDLING_FEE,NOTARY_FEE,CONVENIENCE_FEE,PROCESSING_FEE,MAIL_FEE,VENDORS_COMP_AGENCY' | toDollar }}">
                        </span>
                </div>
                <div class="partial-total-row clearfix">
                    <strong>Total Tax</strong>
						<span>
							$<input type="text" disabled value="{{ taxAndFees.sales_tax | subTotalWithString 'AVALARA_TAX,SALES_TAX_PENALTY,VENDORS_COMP,INTEREST' | toDollar }}">
                        </span>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>