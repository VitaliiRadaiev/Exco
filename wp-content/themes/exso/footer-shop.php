	<?php $lang = pll_current_language(); ?>
	<!-- begin b-footer -->
	<div class="block-newsletter">
		<div class="block-newsletter__wrap">
			<div class="block-newsletter__wrap-desc">
				<div class="title">
					<?php pll_e('p1'); ?>
				</div>
				<p><?php pll_e('p2'); ?></p>
			</div>
			<div class="block-newsletter__wrap-form">
				<?php echo do_shortcode( '[cf7form cf7key="podpiska"]' ); ?>
			</div>
		</div>
	</div>
	<footer class="b-footer footer-big">
		<div class="container-big">
			<div class="row-big">
				<div class="col-xl-big">
					<div class="b-footer-top">
						<div class="b-footer-item logo-block">
							<div class="logo">
								<a href="<?php echo get_home_url(); ?>">
<svg width="140" height="55" viewBox="0 0 140 55" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M39.3127 51.7357C38.9411 51.7357 38.7554 51.55 38.7554 51.1784C38.7554 50.8069 38.9411 50.6212 39.3127 50.6212H41.1703C41.5418 50.6212 41.7276 50.8069 41.7276 51.1784V53.0361C41.7276 53.2219 41.7276 53.4076 41.5418 53.4076C40.7988 54.1507 40.0557 54.5222 39.1269 54.5222C38.1981 54.5222 37.2692 54.1507 36.7119 53.4076C35.9689 52.8503 35.5974 51.9215 35.5974 50.9927C35.5974 50.0639 35.9689 49.135 36.7119 48.5777C37.455 47.8347 38.1981 47.4631 39.1269 47.4631C40.0557 47.4631 40.7988 47.8347 41.5418 48.392C41.7276 48.5777 41.7276 48.5777 41.7276 48.9493C41.7276 49.3208 41.5418 49.5066 41.1703 49.5066C40.9846 49.5066 40.7988 49.5066 40.7988 49.3208C40.4273 48.9493 39.87 48.5777 39.1269 48.5777C38.5696 48.5777 38.0123 48.7635 37.455 49.3208C36.8977 49.8781 36.7119 50.2496 36.7119 50.9927C36.7119 51.55 36.8977 52.1073 37.455 52.6646C37.8265 53.0361 38.3838 53.4076 39.1269 53.4076C39.6842 53.4076 40.2415 53.2219 40.613 52.8503V51.7357H39.3127Z" fill="#575757"/>
<path d="M50.8303 48.0204C50.8303 47.6489 51.0161 47.4631 51.3876 47.4631H54.3599C54.9172 47.4631 55.4745 47.6489 55.846 48.2062C56.2175 48.5777 56.5891 49.135 56.5891 49.8781C56.5891 50.4354 56.4033 50.8069 56.2175 51.1785C55.846 51.55 55.6602 51.9215 55.1029 51.9215L56.7748 53.4076C56.9606 53.5934 56.9606 53.5934 56.9606 53.7792C56.9606 54.3365 56.2175 54.5222 56.0318 54.1507L53.8026 51.9215H51.9449V53.7792C51.9449 54.1507 51.7592 54.3365 51.3876 54.3365C51.0161 54.3365 50.8303 54.1507 50.8303 53.7792V48.0204ZM51.9449 48.5777V50.8069H54.3599C54.7314 50.8069 54.9172 50.6212 55.1029 50.4354C55.2887 50.2496 55.4745 49.8781 55.4745 49.6923C55.4745 49.3208 55.2887 49.135 55.1029 48.9493C54.9172 48.7635 54.7314 48.5777 54.3599 48.5777H51.9449Z" fill="#575757"/>
<path d="M65.6915 50.9927C65.6915 50.0639 66.0631 49.135 66.8061 48.5777C67.5492 47.8347 68.2922 47.4631 69.2211 47.4631C70.1499 47.4631 71.0787 47.8347 71.636 48.5777C72.3791 49.3208 72.7506 50.0639 72.7506 50.9927C72.7506 51.9215 72.3791 52.8503 71.636 53.4076C70.893 54.1507 70.1499 54.5222 69.2211 54.5222C68.2922 54.5222 67.3634 54.1507 66.8061 53.4076C66.0631 52.8503 65.6915 51.9215 65.6915 50.9927ZM66.8061 50.9927C66.8061 51.55 66.9919 52.1073 67.5492 52.6646C67.9207 53.0361 68.478 53.4076 69.2211 53.4076C69.7784 53.4076 70.3357 53.2219 70.893 52.6646C71.2645 52.293 71.636 51.7357 71.636 50.9927C71.636 50.4354 71.4503 49.8781 70.893 49.3208C70.5214 48.9493 69.9641 48.5777 69.2211 48.5777C68.6638 48.5777 68.1065 48.7635 67.5492 49.3208C66.9919 49.6923 66.8061 50.2496 66.8061 50.9927Z" fill="#575757"/>
<path d="M87.0543 48.0204C87.0543 47.6489 87.2401 47.4631 87.6116 47.4631C87.9832 47.4631 88.1689 47.6489 88.1689 48.0204V51.1785C88.1689 52.1073 87.7974 52.8503 87.2401 53.4076C86.6828 53.9649 85.754 54.3365 85.0109 54.3365C84.2679 54.3365 83.339 53.9649 82.7817 53.4076C82.2244 52.8503 81.8529 51.9215 81.8529 51.1785V48.0204C81.8529 47.6489 82.0387 47.4631 82.4102 47.4631C82.7817 47.4631 82.9675 47.6489 82.9675 48.0204V51.1785C82.9675 51.7357 83.1533 52.293 83.5248 52.6646C83.8963 53.0361 84.4536 53.2219 85.0109 53.2219C85.5682 53.2219 86.1255 53.0361 86.497 52.6646C86.8686 52.293 87.0543 51.7357 87.0543 51.1785V48.0204Z" fill="#575757"/>
<path d="M97.4574 48.0204C97.4574 47.6489 97.6432 47.4631 98.0147 47.4631H100.987C101.544 47.4631 102.102 47.6489 102.473 48.2062C102.845 48.5777 103.216 49.135 103.216 49.8781C103.216 50.4354 103.03 50.9927 102.473 51.55C102.102 51.9215 101.544 52.2931 100.801 52.2931H98.3863V54.1507C98.3863 54.5223 98.2005 54.708 97.829 54.708C97.4574 54.708 97.2717 54.5223 97.2717 54.1507V48.0204H97.4574ZM98.572 48.5777V50.8069H100.987C101.359 50.8069 101.544 50.6212 101.73 50.4354C101.916 50.2496 102.102 49.8781 102.102 49.6923C102.102 49.3208 101.916 49.135 101.73 48.9493C101.544 48.7635 101.359 48.5777 100.987 48.5777H98.572Z" fill="#575757"/>
<path d="M106.934 16.5331C106.934 12.0748 108.606 8.17369 111.764 4.82991C115.107 1.48613 119.008 0 123.467 0C127.925 0 131.826 1.67189 135.17 4.82991C138.514 7.98792 140 11.889 140 16.5331C140 20.9915 138.328 24.8926 135.17 28.2364C132.012 31.3944 128.111 33.0663 123.467 33.0663C118.823 33.0663 115.107 31.3944 111.764 28.2364C108.606 24.8926 106.934 20.9915 106.934 16.5331ZM112.507 16.5331C112.507 19.5054 113.621 22.1061 115.665 24.3353C117.894 26.5645 120.495 27.4933 123.467 27.4933C126.439 27.4933 129.04 26.3787 131.269 24.3353C133.498 22.1061 134.613 19.5054 134.613 16.5331C134.613 13.5609 133.498 10.9602 131.269 8.73099C129.04 6.5018 126.625 5.38721 123.467 5.38721C120.309 5.38721 117.894 6.5018 115.665 8.73099C113.436 10.9602 112.507 13.3751 112.507 16.5331Z" fill="#575757"/>
<path d="M92.0724 13.7467H90.2147H87.0567H87.614H82.041C79.8118 13.7467 77.9542 11.889 77.9542 9.65981C77.9542 7.43063 79.8118 5.57297 82.041 5.57297H87.614H87.0567H91.3293H95.2304C96.7165 5.57297 98.0169 4.27261 98.0169 2.78648C98.0169 1.30036 96.7165 0 95.2304 0H84.8275C84.456 0 82.5983 0 82.041 0C76.6538 0 72.3812 4.27261 72.3812 9.65981C72.3812 15.047 76.6538 19.3196 82.041 19.3196H84.0845H87.614H87.0567H92.0724C94.3016 19.3196 96.1592 21.1773 96.1592 23.4065C96.1592 25.6357 94.3016 27.4933 92.0724 27.4933H87.0567H87.614H82.7841H75.1677C73.6816 27.4933 72.3812 28.7937 72.3812 30.2798C72.3812 31.7659 73.6816 33.0663 75.1677 33.0663H89.2859C89.6574 33.0663 91.5151 33.0663 92.0724 33.0663C97.4596 33.0663 101.732 28.7937 101.732 23.4065C101.732 18.0193 97.2738 13.7467 92.0724 13.7467Z" fill="#575757"/>
<path d="M0 2.97215C0 1.48603 1.30036 0.185669 2.78648 0.185669H25.8214C27.3075 0.185669 28.6079 1.48603 28.6079 2.97215C28.6079 4.45828 27.3075 5.75864 25.8214 5.75864H5.57297V13.9323H21.1773C22.6634 13.9323 23.9638 15.2327 23.9638 16.7188C23.9638 18.2049 22.6634 19.5053 21.1773 19.5053H5.57297V27.679H25.8214C27.3075 27.679 28.6079 28.9793 28.6079 30.4655C28.6079 31.9516 27.3075 33.2519 25.8214 33.2519H2.78648C1.30036 33.2519 0 31.9516 0 30.4655V2.97215Z" fill="#B0B0B0"/>
<path d="M54.9865 24.5211L51.0854 20.62L39.1964 32.509C38.0818 33.6236 36.41 33.6236 35.2954 32.509C34.1808 31.3944 34.1808 29.7225 35.2954 28.6079L47.1844 16.7189L35.2954 4.8299C34.7381 4.27261 34.5523 3.71531 34.5523 2.78648C34.5523 1.30036 35.8527 0 37.3388 0C38.0818 0 38.6391 0.185766 39.1964 0.743062L51.0854 12.6321L62.9744 0.743062C63.5317 0.185766 64.2748 0 64.8321 0C67.247 0 68.5474 2.97225 66.6897 4.64414L54.9865 16.3474L58.8876 20.2484C59.4449 20.8057 59.6306 21.363 59.6306 22.1061C59.6306 23.5922 58.3303 24.8926 56.8442 24.8926C56.1011 25.2641 55.358 25.0784 54.9865 24.5211Z" fill="#B0B0B0"/>
<path d="M64.8321 33.252C66.3711 33.252 67.6186 32.0045 67.6186 30.4656C67.6186 28.9266 66.3711 27.6791 64.8321 27.6791C63.2932 27.6791 62.0457 28.9266 62.0457 30.4656C62.0457 32.0045 63.2932 33.252 64.8321 33.252Z" fill="#B0B0B0"/>
</svg>

								</a>
							</div>
							<div class="f-social">
								<span><?php pll_e('soc'); ?>:</span>
								<ul>
									<li><a href="<?php echo get_option('Telegram'); ?>"><svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
<circle cx="15" cy="15" r="14.5" stroke="#808384"/>
<path d="M7.01303 15.2806L10.4616 16.5665L11.8059 20.8918C11.8644 21.184 12.2151 21.2425 12.4489 21.0671L14.3778 19.489C14.5531 19.3136 14.8454 19.3136 15.0792 19.489L18.5277 22.0023C18.7615 22.1777 19.1122 22.0608 19.1707 21.7685L21.7425 9.49399C21.8009 9.20174 21.5087 8.90949 21.2164 9.02639L7.01303 14.5207C6.66232 14.6376 6.66232 15.1637 7.01303 15.2806ZM11.6306 15.9235L18.4108 11.7735C18.5277 11.7151 18.6446 11.8905 18.5277 11.9489L12.975 17.151C12.7996 17.3263 12.6242 17.5601 12.6242 17.8524L12.4489 19.2552C12.4489 19.4305 12.1566 19.489 12.0982 19.2552L11.3968 16.6834C11.2214 16.3911 11.3384 16.0404 11.6306 15.9235Z" fill="#808384"/>
</svg>
</a></li>
									<li><a href="<?php echo get_option('Twitter'); ?>"><svg width="31" height="30" viewBox="0 0 31 30" fill="none" xmlns="http://www.w3.org/2000/svg">
<circle cx="15.5" cy="15" r="14.5" stroke="#808384"/>
<path d="M23.45 11.175C22.925 11.4 22.325 11.55 21.725 11.625C22.325 11.25 22.85 10.65 23.075 9.975C22.475 10.35 21.875 10.575 21.125 10.725C20.6 10.125 19.775 9.75 18.95 9.75C17.3 9.75 15.95 11.1 15.95 12.75C15.95 12.975 15.95 13.2 16.025 13.425C13.55 13.275 11.3 12.075 9.8 10.275C9.575 10.725 9.425 11.25 9.425 11.775C9.425 12.825 9.95 13.725 10.775 14.25C10.25 14.25 9.8 14.1 9.425 13.875C9.425 15.3 10.475 16.575 11.825 16.8C11.6 16.875 11.3 16.875 11 16.875C10.775 16.875 10.625 16.875 10.4 16.8C10.775 18 11.9 18.9 13.25 18.9C12.2 19.725 10.925 20.175 9.5 20.175C9.275 20.175 9.05 20.175 8.75 20.1C10.1 20.925 11.675 21.45 13.4 21.45C18.95 21.45 21.95 16.875 21.95 12.9V12.525C22.55 12.3 23.075 11.775 23.45 11.175Z" fill="#808384"/>
</svg>
</a></li>
									<li><a href="<?php echo get_option('Facebook'); ?>"><svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
<circle cx="15" cy="15" r="14.5" stroke="#808384"/>
<path d="M21.75 10.364C21.75 9.24093 20.7591 8.25 19.636 8.25H11.114C9.99093 8.25 9 9.24093 9 10.364V18.886C9 20.0091 9.99093 21 11.114 21H15.408V16.1775H13.8225V14.0635H15.408V13.2047C15.408 11.7513 16.465 10.4961 17.7863 10.4961H19.5039V12.6101H17.7863C17.5881 12.6101 17.3899 12.8083 17.3899 13.2047V14.0635H19.5039V16.1775H17.3899V21H19.636C20.7591 21 21.75 20.0091 21.75 18.886V10.364Z" fill="#808384"/>
</svg>
</a></li>
									<li><a href="<?php echo get_option('Instagram'); ?>"><svg xmlns="http://www.w3.org/2000/svg" width="31" height="30" viewBox="0 0 31 30" fill="none">
<circle cx="15.5" cy="15" r="14.5" stroke="#808384"/>
<path d="M20.4356 9H11.3144C10.2846 9 9.5 9.78462 9.5 10.8144V19.9356C9.5 20.9654 10.2846 21.75 11.3144 21.75H20.4356C21.4654 21.75 22.25 20.9654 22.25 19.9356V10.8144C22.25 9.78462 21.4654 9 20.4356 9ZM15.875 19.2C17.9837 19.2 19.7 17.5327 19.7 15.5221C19.7 15.1788 19.651 14.7865 19.5529 14.4923H20.6317V19.6904C20.6317 19.9356 20.4356 20.1808 20.1413 20.1808H11.6087C11.3635 20.1808 11.1183 19.9846 11.1183 19.6904V14.4433H12.2462C12.1481 14.7865 12.099 15.1298 12.099 15.4731C12.05 17.5327 13.7663 19.2 15.875 19.2ZM15.875 17.7288C14.5019 17.7288 13.4231 16.65 13.4231 15.326C13.4231 14.0019 14.5019 12.9231 15.875 12.9231C17.2481 12.9231 18.3269 14.0019 18.3269 15.326C18.3269 16.699 17.2481 17.7288 15.875 17.7288ZM20.5827 12.4817C20.5827 12.776 20.3375 13.0212 20.0433 13.0212H18.6702C18.376 13.0212 18.1308 12.776 18.1308 12.4817V11.1577C18.1308 10.8635 18.376 10.6183 18.6702 10.6183H20.0433C20.3375 10.6183 20.5827 10.8635 20.5827 11.1577V12.4817Z" fill="#808384"/>
</svg></a></li>
								</ul>
							</div>
							<div class="f-contacts">
								<div class="b-footer-item__top">
									<span><?php pll_e('cont'); ?></span>
								</div>
								<ul>
									<li><a href="tel:<?php echo get_option('tel'); ?>"><?php echo get_option('tel'); ?></a><a href="tel:<?php echo get_option('tel2'); ?>"><?php echo get_option('tel2'); ?></a></li>
									<li><span><?php pll_e('adr'); ?></span></li>
									<li><span><?php pll_e('time'); ?></span></li>
									<li><a href="mailto:<?php echo get_option('email'); ?>"><?php echo get_option('email'); ?></a></li>
								</ul>
							</div>
						</div>
						<div class="b-footer-item b-footer-item__nav">
							<div class="b-footer-item__top">
								<span><?php pll_e('cat-2'); ?></span>
							</div>
							<?php wp_nav_menu(array('theme_location' => 'woo-menu', 'container' => 'false' , 'container_class' => 'false')); ?>
						</div>
						<div class="b-footer-item">
							<div class="b-footer-item__top">
								<span><?php pll_e('Компьютерная вышивка'); ?></span>
							</div>
							<?php wp_nav_menu(array('theme_location' => 'footer-nav', 'container' => 'false' , 'container_class' => 'false')); ?>
						</div>
						<div class="b-footer-item">
							<div class="b-footer-item__top">
								<span><?php pll_e('Термопечать'); ?></span>
							</div>
							<?php wp_nav_menu(array('theme_location' => 'footer-nav2', 'container' => 'false' , 'container_class' => 'false')); ?>
						</div>
						<div class="b-footer-item">
							<div class="b-footer-item__top">
								<span><?php pll_e('Одежда'); ?></span>
							</div>
							<?php wp_nav_menu(array('theme_location' => 'footer-nav3', 'container' => 'false' , 'container_class' => 'false')); ?>
						</div>
					</div>	
					<div class="b-footer-bottom">
						<? if(get_option('copyright')){?><span class="b-copyright"><? echo get_option('copyright'); ?></span><?}?>
						<div class="card-block">
							<div class="card-block__item">
								<svg width="53" height="32" viewBox="0 0 53 32" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M52.047 15.6141C52.047 24.1818 45.0807 31.2282 36.4329 31.2282C27.8652 31.2282 20.8188 24.1818 20.8188 15.6141C20.8188 7.04635 27.7851 0 36.3528 0C45.0807 0 52.047 7.04635 52.047 15.6141Z" fill="#F9B50B"/>
<path d="M31.1481 15.6941C31.1481 14.5731 30.9879 13.4521 30.8278 12.4112H21.2191C21.2992 11.8507 21.4593 11.3702 21.6195 10.7297H30.1872C30.0271 10.1692 29.7869 9.60866 29.5466 9.04816H22.2601C22.5003 8.48765 22.8206 8.00722 23.1409 7.36664H28.6658C28.3456 6.80614 27.9452 6.24563 27.4648 5.68512H24.422C24.9024 5.12462 25.3829 4.64419 26.0235 4.08368C23.301 1.52137 19.6177 0 15.534 0C7.04635 0.240217 0 7.04635 0 15.6141C0 24.1818 6.96628 31.2282 15.6141 31.2282C19.6978 31.2282 23.301 29.6267 26.1035 27.1445C26.664 26.664 27.1445 26.1035 27.705 25.463H24.5021C24.1017 24.9825 23.7014 24.422 23.3811 23.8615H28.826C29.1463 23.3811 29.4666 22.8206 29.7068 22.18H22.4202C22.18 21.6996 21.9398 21.1391 21.7796 20.4985H30.3474C30.8278 19.0572 31.1481 17.4557 31.1481 15.6941Z" fill="#C8191C"/>
<path d="M21.1391 19.6177L21.3793 18.1764C21.2992 18.1764 21.1391 18.2565 20.9789 18.2565C20.4184 18.2565 20.3384 17.9362 20.4184 17.7761L20.8989 14.8935H21.7797L22.0199 13.292H21.2192L21.3793 12.3312H19.6978C19.6978 12.3312 18.7369 17.7761 18.7369 18.4167C18.7369 19.3775 19.2974 19.858 20.0982 19.858C20.5786 19.858 20.9789 19.6978 21.1391 19.6177Z" fill="white"/>
<path d="M21.6996 16.9754C21.6996 19.2975 23.3011 19.858 24.5822 19.858C25.7833 19.858 26.3438 19.6178 26.3438 19.6178L26.6641 18.0163C26.6641 18.0163 25.7833 18.4167 24.9025 18.4167C23.0608 18.4167 23.3811 17.0554 23.3811 17.0554H26.7442C26.7442 17.0554 26.9844 16.0145 26.9844 15.5341C26.9844 14.4931 26.4239 13.1319 24.5822 13.1319C22.9808 13.0518 21.6996 14.8935 21.6996 16.9754ZM24.5822 14.5732C25.463 14.5732 25.3029 15.6142 25.3029 15.6942H23.4612C23.5413 15.6142 23.7014 14.5732 24.5822 14.5732Z" fill="white"/>
<path d="M35.0716 19.6177L35.3919 17.776C35.3919 17.776 34.5912 18.1764 33.9506 18.1764C32.8296 18.1764 32.2691 17.2956 32.2691 16.2547C32.2691 14.2528 33.23 13.2119 34.4311 13.2119C35.2318 13.2119 35.9524 13.6923 35.9524 13.6923L36.1926 11.9308C36.1926 11.9308 35.2318 11.5304 34.2709 11.5304C32.3492 11.5304 30.5075 13.2119 30.5075 16.3347C30.5075 18.4166 31.4684 19.7778 33.4702 19.7778C34.1908 19.8579 35.0716 19.6177 35.0716 19.6177Z" fill="white"/>
<path d="M12.091 13.0518C10.97 13.0518 10.0892 13.372 10.0892 13.372L9.84894 14.8133C9.84894 14.8133 10.5696 14.4931 11.6906 14.4931C12.2511 14.4931 12.7315 14.5731 12.7315 15.0536C12.7315 15.3739 12.6515 15.4539 12.6515 15.4539H11.9308C10.4895 15.4539 8.96815 16.0144 8.96815 17.9362C8.96815 19.4575 9.92901 19.7778 10.5696 19.7778C11.6906 19.7778 12.2511 19.0572 12.3312 19.0572L12.2511 19.6978H13.6123L14.2529 15.1336C14.2529 13.1318 12.6515 13.0518 12.091 13.0518ZM12.4113 16.7351C12.4113 16.9753 12.2511 18.3365 11.2902 18.3365C10.8098 18.3365 10.6497 17.9362 10.6497 17.6959C10.6497 17.2956 10.8899 16.7351 12.171 16.7351C12.3312 16.7351 12.4113 16.7351 12.4113 16.7351Z" fill="white"/>
<path d="M15.8543 19.7778C16.2547 19.7778 18.3365 19.8579 18.3365 17.6159C18.3365 15.534 16.3347 15.9343 16.3347 15.1336C16.3347 14.7333 16.655 14.5731 17.2155 14.5731C17.4557 14.5731 18.3365 14.6532 18.3365 14.6532L18.5768 13.1318C18.5768 13.1318 18.0163 12.9717 16.9753 12.9717C15.7742 12.9717 14.4931 13.4521 14.4931 15.1336C14.4931 17.0554 16.575 16.8952 16.575 17.6159C16.575 18.0963 16.0145 18.1764 15.6141 18.1764C14.8934 18.1764 14.0927 17.9362 14.0927 17.9362L13.8525 19.4575C14.0126 19.6177 14.4931 19.7778 15.8543 19.7778Z" fill="white"/>
<path d="M48.8441 11.7706L48.5238 14.0127C48.5238 14.0127 47.8832 13.2119 46.9224 13.2119C45.401 13.2119 44.1198 15.0536 44.1198 17.2155C44.1198 18.5768 44.7604 19.938 46.2017 19.938C47.1626 19.938 47.8032 19.2974 47.8032 19.2974L47.7231 19.8579H49.4046L50.6057 11.9308L48.8441 11.7706ZM48.0434 16.0945C48.0434 16.9753 47.643 18.1764 46.6821 18.1764C46.1216 18.1764 45.8014 17.696 45.8014 16.8152C45.8014 15.454 46.3619 14.6532 47.1626 14.6532C47.7231 14.7333 48.0434 15.1337 48.0434 16.0945Z" fill="white"/>
<path d="M3.04282 19.6978L4.00369 13.7724L4.16383 19.6978H5.28484L7.44679 13.7724L6.566 19.6978H8.32758L9.68881 11.7706H6.96636L5.28484 16.655L5.20477 11.7706H2.8026L1.44138 19.6978H3.04282Z" fill="white"/>
<path d="M28.6659 19.6978C29.1463 16.9753 29.2264 14.7333 30.4275 15.1336C30.5876 14.0927 30.8278 13.6123 30.988 13.2119H30.6677C29.947 13.2119 29.3064 14.1728 29.3064 14.1728L29.4666 13.292H27.8651L26.8242 19.6978H28.6659Z" fill="white"/>
<path d="M38.9151 13.0518C37.7941 13.0518 36.9133 13.372 36.9133 13.372L36.6731 14.8133C36.6731 14.8133 37.3937 14.4931 38.5147 14.4931C39.0752 14.4931 39.5557 14.5731 39.5557 15.0536C39.5557 15.3739 39.4756 15.4539 39.4756 15.4539H38.755C37.3137 15.4539 35.7923 16.0144 35.7923 17.9362C35.7923 19.4575 36.7532 19.7778 37.3937 19.7778C38.5147 19.7778 39.0752 19.0572 39.1553 19.0572L39.0752 19.6978H40.5966L41.2372 15.1336C41.2372 13.1318 39.4756 13.0518 38.9151 13.0518ZM39.3155 16.7351C39.3155 16.9753 39.1553 18.3365 38.1945 18.3365C37.714 18.3365 37.5539 17.9362 37.5539 17.6959C37.5539 17.2956 37.7941 16.7351 39.0752 16.7351C39.2354 16.7351 39.2354 16.7351 39.3155 16.7351Z" fill="white"/>
<path d="M42.5184 19.6978C42.9988 16.9753 43.0789 14.7333 44.28 15.1336C44.4401 14.0927 44.6803 13.6123 44.8405 13.2119H44.5202C43.7995 13.2119 43.159 14.1728 43.159 14.1728L43.3191 13.292H41.7176L40.6767 19.6978H42.5184Z" fill="white"/>
</svg>

							</div>
							<div class="card-block__item">
								<svg width="51" height="31" viewBox="0 0 51 31" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M25.7558 26.8242C28.7985 24.0217 30.7203 20.0181 30.7203 15.6141C30.7203 11.1301 28.7985 7.12646 25.7558 4.40401C23.0333 2.00184 19.5101 0.480469 15.5866 0.480469C7.17903 0.480469 0.372898 7.28661 0.372898 15.6141C0.372898 24.0217 7.17903 30.8278 15.5866 30.8278C19.5101 30.7478 23.0333 29.2264 25.7558 26.8242Z" fill="#3362AB"/>
<path d="M25.7558 26.8243C28.7986 24.0217 30.7203 20.0181 30.7203 15.6142C30.7203 11.1301 28.7986 7.12651 25.7558 4.40405" fill="#3362AB"/>
<path d="M25.7558 26.8243C28.7986 24.0217 30.7203 20.0181 30.7203 15.6142C30.7203 11.1301 28.7986 7.12651 25.7558 4.40405" stroke="#3362AB" stroke-width="0.247984"/>
<path d="M35.925 0.400391C32.0015 0.400391 28.3982 1.92176 25.7558 4.32392C25.1953 4.80436 24.7149 5.36486 24.2344 5.92537H27.2772C27.6775 6.4058 28.0779 6.9663 28.3982 7.52681H23.0334C22.7131 8.00724 22.3928 8.56775 22.1526 9.12825H29.279C29.5192 9.68876 29.7594 10.1692 29.9196 10.7297H21.512C21.3519 11.2902 21.1917 11.7706 21.0316 12.3311H30.3199C30.5602 13.3721 30.6402 14.413 30.6402 15.534C30.6402 17.2155 30.4 18.817 29.8395 20.3384H21.4319C21.5921 20.8989 21.8323 21.4594 22.0725 21.9398H29.1989C28.9587 22.5003 28.6384 23.0608 28.3181 23.5412H22.9533C23.2736 24.1018 23.6739 24.6623 24.0743 25.1427H27.117C26.6366 25.7032 26.1562 26.2637 25.5957 26.7441C28.3181 29.1463 31.8413 30.6677 35.7648 30.6677C44.1724 30.6677 50.8985 23.8615 50.8985 15.454C51.1387 7.20653 44.3326 0.400391 35.925 0.400391Z" fill="#C9191B"/>
<path d="M13.6649 19.2974H11.7432L12.8642 13.3721L10.3019 19.2974H8.62039L8.3001 13.4521L7.17907 19.2974H5.49758L6.93887 11.6105H9.90155L10.0617 16.4148L12.1436 11.6105H15.1863L13.6649 19.2974Z" fill="white"/>
<path d="M34.8039 19.2974C34.3235 19.4576 33.8431 19.5376 33.4427 19.5376C32.4819 19.5376 31.9214 19.0572 31.9214 18.1764C31.9214 18.0163 31.9213 17.776 32.0014 17.6159L32.0815 16.9753L32.1616 16.4949L33.0424 11.6906H34.884L34.6438 13.1319H35.6047L35.3645 14.6532H34.4036L33.9232 17.2956C33.9232 17.3757 33.9232 17.5358 33.9232 17.5358C33.9232 17.8561 34.1634 18.0163 34.5637 18.0163C34.804 18.0163 34.9641 18.0163 35.0442 17.9362L34.8039 19.2974Z" fill="white"/>
<path d="M40.2488 13.1318C40.0887 13.0518 40.0887 13.0518 40.0086 13.0518C39.9285 13.0518 39.8485 13.0518 39.8485 13.0518C39.7684 13.0518 39.6883 13.0518 39.6082 13.0518C38.9677 13.0518 38.5673 13.292 37.9267 14.0927L38.0869 13.1318H36.5655L35.4445 19.3775H37.3662C38.0068 15.534 38.3271 14.8934 39.2079 14.8934C39.288 14.8934 39.368 14.8934 39.4481 14.8934L39.6883 14.9735L40.2488 13.1318Z" fill="white"/>
<path d="M27.2772 15.0537C27.2772 15.8544 27.7576 16.4149 28.7185 16.8153C29.5192 17.1356 29.5992 17.2156 29.5992 17.5359C29.5992 17.9363 29.279 18.0964 28.4782 18.0964C27.9177 18.0964 27.3572 18.0164 26.7967 17.8562L26.5565 19.2975H26.6366L26.9569 19.3776C27.0369 19.3776 27.2772 19.4577 27.4373 19.4577C27.9177 19.4577 28.238 19.5377 28.4782 19.5377C30.48 19.5377 31.4409 18.8971 31.4409 17.4558C31.4409 16.5751 31.0405 16.0946 30.0797 15.6943C29.279 15.374 29.1989 15.2939 29.1989 14.9736C29.1989 14.6533 29.5192 14.4932 30.1598 14.4932C30.5601 14.4932 31.0406 14.4932 31.521 14.5732L31.7612 13.1319C31.2808 13.0519 30.5601 12.9718 30.0797 12.9718C27.9978 12.9718 27.2772 13.9327 27.2772 15.0537Z" fill="white"/>
<path d="M18.4692 16.575C18.229 16.575 18.1489 16.575 18.0688 16.575C17.0279 16.575 16.4674 16.8953 16.4674 17.5359C16.4674 17.9363 16.7076 18.1765 17.108 18.1765C17.8286 18.0964 18.3891 17.4558 18.4692 16.575ZM19.8304 19.2975H18.229L18.3091 18.6569C17.8286 19.1374 17.1881 19.3776 16.3073 19.3776C15.2663 19.3776 14.6257 18.6569 14.6257 17.6961C14.6257 16.1747 15.8268 15.2939 17.9087 15.2939C18.1489 15.2939 18.3891 15.2939 18.7094 15.374C18.7895 15.1338 18.7895 15.0537 18.7895 14.9736C18.7895 14.5732 18.4692 14.4131 17.5884 14.4131C17.0279 14.4131 16.4674 14.4932 16.067 14.5732L15.8268 14.6533L15.6667 14.7334L15.9069 13.2921C16.8678 13.0519 17.4283 12.9718 18.1489 12.9718C19.7504 12.9718 20.6312 13.6124 20.6312 14.8135C20.6312 15.1338 20.6311 15.374 20.471 16.0145L20.0706 18.2566L19.9906 18.6569L19.9105 18.9772V19.2174L19.8304 19.2975Z" fill="white"/>
<path d="M25.0352 15.4539C25.0352 15.2938 25.0352 15.2137 25.0352 15.1336C25.0352 14.6532 24.7149 14.3329 24.1544 14.3329C23.5138 14.3329 23.1134 14.7333 22.9533 15.4539H25.0352ZM25.996 19.2173C25.3554 19.3775 24.7149 19.4575 24.0743 19.4575C21.9924 19.4575 20.8714 18.4967 20.8714 16.655C20.8714 14.4931 22.2326 12.8916 24.1544 12.8916C25.6757 12.8916 26.7167 13.7724 26.7167 15.1336C26.7167 15.6141 26.6366 16.0144 26.4764 16.655H22.7131C22.7131 16.7351 22.7131 16.8151 22.7131 16.8151C22.7131 17.5358 23.2735 17.9362 24.3946 17.9362C25.0351 17.9362 25.6757 17.776 26.3964 17.5358L25.996 19.2173Z" fill="white"/>
<path d="M44.1724 15.6943C44.1724 15.0537 43.9322 14.4131 43.1315 14.4131C42.1706 14.4131 41.6101 15.5341 41.6101 16.575C41.6101 17.4558 42.0105 18.0164 42.7311 18.0164C43.1315 18.0164 44.0123 17.4558 44.1724 16.495C44.1724 16.2548 44.1724 15.9345 44.1724 15.6943ZM46.1742 16.495C45.8539 18.5768 44.4126 19.5377 42.4909 19.5377C40.3289 19.5377 39.5282 18.2566 39.5282 16.6551C39.5282 14.4131 40.9695 12.9718 43.2115 12.9718C45.2133 12.9718 46.1742 14.1729 46.1742 15.7743C46.2543 16.0946 46.2543 16.0946 46.1742 16.495Z" fill="white"/>
</svg>

							</div>
							<div class="card-block__item">
								<svg width="55" height="18" viewBox="0 0 55 18" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M51.3167 0.446777H47.8736C46.8326 0.446777 46.0319 0.767066 45.5515 1.808L38.9856 16.7815H43.6297C43.6297 16.7815 44.4305 14.7797 44.5906 14.2993C45.071 14.2993 49.6352 14.2993 50.2757 14.2993C50.4359 14.8598 50.8362 16.7014 50.8362 16.7014H55L51.3167 0.446777ZM45.8718 10.9362C46.2721 9.97537 47.6334 6.37212 47.6334 6.37212C47.6334 6.45219 48.0337 5.41125 48.1939 4.85075L48.5141 6.29205C48.5141 6.29205 49.3949 10.2156 49.5551 11.0163H45.8718V10.9362Z" fill="#3362AB"/>
<path d="M39.3058 11.4166C39.3058 14.7797 36.2631 17.0217 31.5388 17.0217C29.537 17.0217 27.6153 16.6213 26.5744 16.1409L27.2149 12.4576L27.7754 12.6978C29.2167 13.3384 30.1776 13.5786 31.9392 13.5786C33.2203 13.5786 34.5816 13.0982 34.5816 11.9772C34.5816 11.2565 34.0211 10.7761 32.2595 9.97535C30.578 9.17463 28.3359 7.89347 28.3359 5.57138C28.3359 2.36849 31.4588 0.206543 35.8627 0.206543C37.5442 0.206543 38.9855 0.526832 39.8663 0.927193L39.2258 4.45037L38.9055 4.13008C38.1047 3.80979 37.0638 3.4895 35.5424 3.4895C33.8609 3.56957 33.0602 4.29022 33.0602 4.9308C33.0602 5.65145 34.0211 6.21196 35.5424 6.93261C38.1047 8.13369 39.3058 9.49492 39.3058 11.4166Z" fill="#3362AB"/>
<path d="M0.230618 0.60691L0.31069 0.286621H7.1969C8.15776 0.286621 8.87841 0.60691 9.11863 1.64785L10.64 8.85434C9.11863 5.01088 5.59545 1.88806 0.230618 0.60691Z" fill="#F9B50B"/>
<path d="M20.3288 0.446771L13.3625 16.7014H8.63822L4.63461 3.08915C7.51721 4.93081 9.91937 7.81341 10.8002 9.81522L11.2806 11.4967L15.6045 0.366699H20.3288V0.446771Z" fill="#3362AB"/>
<path d="M22.1704 0.366699H26.5744L23.7719 16.7014H19.3679L22.1704 0.366699Z" fill="#3362AB"/>
</svg>

							</div>
						</div>
						<a target="_blank" href="https://www.weblancer.net/users/Bazilevskyi/" class="b-footer-block">
							<span>Created by</span>
							<i class="b-footer-block__ico"></i>
						</a>
					</div>														
				</div>
			</div>
		</div>
	</footer>
	<!-- end b-footer -->	

</div>
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBv9-H5GwlZA4EkUorU0gGHrq0H4pFMPS4"></script>

<? wp_footer();?>

<script>

	jQuery(document).ready(function($) {

		if($('.widget_shopping_cart_content form .woocommerce-cart-form__cart-item').length < 1){
			$('#orderIssue').addClass('empty');
		}else{
			$('#orderIssue').removeClass('empty');
		}
		$(window).on('load',  function(event) {
			$('.cart-contents').on('click', function(event) {
				event.preventDefault();
				$( "#orderIssue" ).addClass('active');
			});
			$('.close-cart').on('click', function(event) {
				event.preventDefault();
				$( "#orderIssue" ).removeClass('active');
			});
		});
		$( document.body ).on( 'added_to_cart removed_from_cart', function(){
			var arrText = new Array();
			$('.product-name span').each(function(){
				arrText.push($(this).text());
			});
			$('#productName').val(arrText);
			if($('.widget_shopping_cart_content form .woocommerce-cart-form__cart-item').length < 1){
				$('#orderIssue').addClass('empty');
			}else{
				$('#orderIssue').removeClass('empty');
			}
			$( "#orderIssue" ).addClass('active');
			$('.cart-contents').on('click', function(event) {
				event.preventDefault();
				$( "#orderIssue" ).addClass('active');
			});
			$('.close-cart').on('click', function(event) {
				event.preventDefault();
				$( "#orderIssue" ).removeClass('active');
			});
		});
		});
	jQuery(document).on('submit', '.shop_table.cart form', function() {
		updateMiniCartQuantity();
		return false;
	});

	function updateMiniCartQuantity() {
		var cartForm = jQuery('.shop_table.cart form');
		jQuery('<input />').attr('type', 'hidden')
			.attr('name', 'update_cart')
			.attr('value', 'Update Cart')
			.appendTo(cartForm);

		var formData = cartForm.serialize();
		jQuery.ajax({
			type: cartForm.attr('method'),
			url: cartForm.attr('action'),
			data: formData,
			dataType: 'html',
			success: function(response) {
				//console.log(response);

				let wc_cart_fragment_url = (wc_cart_fragments_params.wc_ajax_url).replace("%%endpoint%%", "get_refreshed_fragments");
				jQuery.ajax({
					type: 'post',
					url: wc_cart_fragment_url,
					success: function(response) {
						//console.log(response);
						var mini_cart_wrapper = jQuery('.widget_shopping_cart_content');
						var parent = mini_cart_wrapper.parent();
						mini_cart_wrapper.remove();
						parent.append(response.fragments['div.widget_shopping_cart_content']);
					},
					complete: function() {
						cartForm = jQuery('.shop_table.cart form');
						jQuery('.close-cart').on('click', function(event) {
							event.preventDefault();
							jQuery( "#orderIssue" ).removeClass('active');
						});

					}
				});
			}
		});
	}
</script>
</div>
</body>
</html>