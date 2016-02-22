<?php

class HTMLGameRenderer implements GameRenderer{
    public function render(Board $board, BoardRenderer $boardRenderer, CellRenderer $cellRenderer) {
        $this->renderGameStart();
        $boardRenderer->render($board, $cellRenderer);
        $this->renderGameControls($board->getDimension());
        $this->renderGameEnd();
    }
    
    private function renderGameStart() {
        ob_start(); ?>
            <div style="display: inline-block;">
        <?php echo ob_get_clean();
    }
    
    private function renderGameEnd() {
        ob_start(); ?>
            </div>
        <?php echo ob_get_clean();
    }
    
    private function renderGameControls(BoardDimension $dimension) {
        ob_start(); ?>
            <style>
                .newgame {
                    float: left;
                }
                .advancegame {
                    float: right;
                }
                .likeabutton {
                    appearance: button;
                    -moz-appearance: button;
                    -webkit-appearance: button;
                    text-decoration: none; font: menu; color: ButtonText;
                    font-weight: bold;
                    text-transform: uppercase;
                    display: inline-block; padding: 2px 8px;
                    margin-top: 4px;
                }
            </style>
            <script type="text/javascript">
                    function showNewgameForm() {
                         document.querySelectorAll('#newgame-form')[0].style.display = 'block';
                    }
            </script>
            <div style="clear:both;">
            <a id="advancegame" class="advancegame likeabutton" href="index.php?q=advance">Advance</a>
            <a id="newgame" class="newgame likeabutton" href="#" onclick="showNewgameForm(); return false;">New</a>
            </div>
            <div id="newgame-form" style="display:none; clear:both; padding-top: 10px;">
                <form action="index.php" method="get">
                    <input type="hidden" name="q" value="newgame">
<!--                    &nbsp;&nbsp;&nbsp;<select name="b">
                        <option value="BoundedBoard" selected="selected">BoundedBoard</option>
                        <option VALUE="EdgesWrappedBoard">EdgesWrappedBoard</option>
                    </select><br>-->
                    R:&nbsp;<input type="text" name="r" maxlength="3" value="<?php echo $dimension->getNumRows();?>"><br>
                    C:&nbsp;<input type="text" name="c" maxlength="3" value="<?php echo $dimension->getNumCols();?>"><br>
                    <input type="submit" class="likeabutton" value="Submit">
                </form>
            </div>
        <?php echo ob_get_clean();
    }
}
