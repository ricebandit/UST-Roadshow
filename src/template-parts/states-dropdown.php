<?php

/**
 * States Dropdown
 *
 * @package roads
 */

 if(get_field('states_dropdown', 84)){
    $states = get_field('states_dropdown', 84);

    $currentState = false;
    if(get_field('state')['value']){
        $currentState = get_field('state')['label'];
    }
?>
<form>
    
    <select name="states_dd" id="states_dd" onchange="stateSelect()">
        <?php if($currentState === false){ ?>
        <option value="none" selected disabled hidden>Select a state</option>
        <?php } ?>
<?php
    for($i = 0; $i < count($states); $i++){
        $state = $states[$i];

        if($currentState){
            $stateText = str_replace(' ', '', $state['display_text']);
            $currentState = str_replace(' ', '', $currentState);
            if( $currentState == $stateText){
                $selected = 'selected';
            }
            

        }

?>
    <option value="<?php echo $state['value']; ?>" <?php echo $selected; ?>><?php echo $state['display_text'] ?></option>

    <?php $selected = ''; ?>
<?php
    }
?>
    </select>
</form>

<?php
 }else{
    echo "No State Dropdown Element Found";
 }
?>

