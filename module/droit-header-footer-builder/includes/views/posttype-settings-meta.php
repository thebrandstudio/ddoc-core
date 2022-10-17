<div class="dtdr-meta-section">
    
    <div class="section-block">
        <label for="drdt_template_type"><?php echo esc_html__('Type of Template', 'droithead')?></label>
        <?php if( !empty($type) ){
            ?>
            <select name="drdtdata[type]" id="drdt_template_type">
            <?php
            foreach($type as $k=>$v):
                $selected = selected( ($data['type']) ?? '', $k, 'selected');
                ?>
                    <option value="<?php echo esc_attr($k);?>" <?php echo esc_attr($selected);?> >
                <?php
                echo esc_html($v);
                ?>
                </option>
                <?php
            endforeach;
            ?>
            </select>
            <?php
        }?>
    </div>

    <div class="section-block">
        <label for="drdt_template_display"><?php echo esc_html__('Disply on', 'droithead')?></label>
        <?php if( !empty($display) ){
            ?>
            <select name="drdtdata[display][]" id="drdt_template_display" multiple style="width: 50%;height: 300px">
            <?php
            $selected = '';
            foreach($display as $k=>$v):
                if( is_array($v) && !empty($v) ){
                    $title = ($v['title']) ??  ucfirst( str_replace(['_', '-'], ' ', $k) ) ;
                    ?>
                    <optgroup label="<?php echo esc_attr($title);?>">
                    <?php
                    $options = ($v['options']) ?? [];
                    foreach( $options as $kd=>$d){
                        $selected = in_array($kd, ($data['display']) ?? []) ? 'selected' : '';
                        ?>
                        <option value="<?php echo esc_attr($kd)?>" <?php echo esc_attr($selected); ?>>
                        <?php
                        echo esc_html($d);
                        ?>
                       </option>
                    <?php
                    }
                    ?>
                   </optgroup>
                    <?php
                } else {
                    $selected = in_array($k, ($data['display']) ?? []) ? 'selected' : '';
                    ?>
                    <option value="<?php echo esc_attr($k);?>" <?php echo esc_attr($selected); ?>>
                    <?php
                    echo esc_html($v);
                    ?>
                    </option>
                    <?php
                }
            endforeach;
            ?>
            </select>
            <?php
        }?>
    </div>
   
    <div class="section-block is-active-404-wrapper">
    <?php  $get_currnt_value = get_post_meta($post->ID, 'is_droit_404_active', true); ?>
         
        <div class="droit-error"></div>
        <div class="switch switch--horizontal d-flex">
        <input data-post-id = <?php echo esc_attr($post->ID); ?> id="radio-a" type="radio" name="is_droit_404_active" value="no" <?php checked( $get_currnt_value, 'no' ); ?> class="is-active-404"/>
        <label for="radio-a">Off</label>
        <input data-post-id = <?php echo esc_attr($post->ID); ?> id="radio-b" type="radio" name="is_droit_404_active" value="yes" <?php checked( $get_currnt_value, 'yes' ); ?> class="is-active-404"/>
        <label for="radio-b">On</label><span class="toggle-outside"><span class="toggle-inside"></span></span>
        </div>
        <small>If Enable this options 404 will overgiht from here </small>
    </div>

</div>
