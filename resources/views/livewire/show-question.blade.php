<div>
    <div>
        <div class="card card-statistics mb-30">
            <div class="card-body">
                <h5 class="card-title"> {{$data[$counter]->title}}</h5>

                @foreach(preg_split('/(-)/', $data[$counter]->answers) as $index=>$answer)
                    <div class="custom-control custom-radio">
                        <input type="radio" id="customRadio{{$index}}" name="customRadio" class="custom-control-input" inh>
                        {{-- P0-8 fix: send ONLY question_id and the chosen answer — server looks up right_answer & score --}}
                        <label class="custom-control-label" for="customRadio{{$index}}" wire:click="nextQuestion({{$data[$counter]->id}}, '{{ addslashes($answer) }}')"> {{$answer}}</label>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

</div>
