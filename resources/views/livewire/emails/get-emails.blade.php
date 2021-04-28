<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h4>
                <b class="display-5">
                    {{ __('Select Emails to Send to') }}
                </b>
                <div>
                    @if (session()->has('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>

            </h4>

            <hr>

            <div class="form-group">
                <select name="group" id="group" wire:model="group" class="form-control">
                    <option value="">Select Group...</option>
                    <option value="Tax Matrix">Tax Matrix</option>
                    <option value="Tourism and Logistics">Tourism and Logistics</option>
                    <option value="Mining and Extraction">Mining and Extraction</option>
                    <option value="Local and State Owned">Local and State Owned</option>
                    <option value="Manufacturing and Agro">Manufacturing and Agro</option>
                    <option value="Financial and ICT">Financial and ICT</option>
                </select>
            </div>

            <div class="text-center mx-5 ">
                <button wire:click="SendToGroup" class="btn btn-primary float-lg-right rounded mx-5 px-5 text-lg-center"> Send To Selected Group</button>
                <button wire:click="SendEmail" class="btn btn-info float-lg-right rounded mx-5 px-5 text-lg-center"> Send Emails</button>
            </div>
        </div>


        <div class="card-body">
            <div class="table table-responsive">
                <table class="table table-responsive table-striped table-bordered flex-fill" width="100%">
                    <thead>
                    <tr>
                        <th>Company Name</th>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Group</th>
                        <th>Email Address</th>
                        <th>Action</th>
                        <th>Action</th>
                    </tr>
                    <tbody>
                    @foreach($emails as $email)
                        <tr>
                            <td> {{ $email->company_name }} </td>
                            <td> {{ $email->name }} </td>
                            <td> {{ $email->position }} </td>
                            <td> {{ $email->user_group }} </td>
                            <td> {{ $email->email }} </td>
                            <td>
                                <div class="d-inline">
                                    <input type="checkbox" class="form-control-sm text-lg-center" value="{{ $email->id }}" wire:model="checked_emails.{{ $email->id }}.id" checked />
                                </div>

                            </td>
                            <td>
                                <a class="btn bt-sm btn-danger col-sm" wire:click="RemoveEmail({{ $email->id }})">Remove</a>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                    </thead>
                </table>

            </div>
        </div>
    </div>
</div>
