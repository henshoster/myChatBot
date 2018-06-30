<form action="<?=htmlentities($_SERVER['PHP_SELF']);?>" method="post">
    <textarea class="form-control" id="conversation" rows="10" disabled><?php for ($i = 0; $i < count($this->chat_history); $i++) {
    foreach ($this->chat_history[$i] as $key => $value) {
        echo "$value \n";
    }}?>
    </textarea>
    <div class="input-group my-3">
        <input type="text" class="form-control" id="question" name="question" placeholder="enter your question here">
        <div class='input-group-append'>
            <button class='btn btn-outline-secondary' name='send' type='submit'>Send</button>
        </div>
    </div>
    <button class='btn btn-outline-danger btn-block' name='clearhistory' type='submit'>Clear History</button>
</form>

