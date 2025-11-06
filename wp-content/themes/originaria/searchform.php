<?php
/**
 * The template for displaying search forms
 *
 * @package Originaria
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="input-group">
		<input 
			type="search" 
			class="form-control input-bg" 
			placeholder="<?php echo esc_attr_x( 'Buscar...', 'placeholder', 'originaria' ); ?>" 
			value="<?php echo get_search_query(); ?>" 
			name="s"
		/>
		<button type="submit" class="btn btn-dark-gray btn-small">
			<i class="ti-search"></i> Buscar
		</button>
	</div>
</form>

