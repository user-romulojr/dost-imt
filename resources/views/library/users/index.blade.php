@extends('dashboard')

@section('title', 'Users')

@section('table-content')
        <!--
        <div>
            <a href="{{route('hnrda.create')}}">Add HNRDA</a>
        </div>
        !-->
            <thead>
                <tr>
                    <th>NAME</th>
                    <th>AGENCY</th>
                    <th>EMAIL ADDRESS</th>
                    <th>CONTACT</th>
                    <th>ACCESS LEVEL</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @foreach($allUser as $User)
                    <tr>
                        
                        <td> {{ $User->name }} </td>
                        <td> {{ $User->agency }} </td>
                        <td> {{ $User->email }} </td>
                        <td> {{ $User->contact }} </td>
                        <td><span style="-webkit-text-stroke-width: 0.5px;
                                        -webkit-text-stroke-color: {{ $colorCode[$User->role] }};"> 
                                {{ $accessLevel[$User->role] }} 
                        </span></td>

                        <td>
                            <a href="{{ route('user.edit', ['user' => $User]) }}" class="action-edit">
                                Edit
                            </a>
                        </td>

                        <td>
                            <form method="post" action="{{ route('user.destroy', ['user' => $User]) }}">
                                @csrf
                                @method('delete')
                                <input class="submit-delete" type="submit" value="Delete">
                            </form>
                        </td>
                        
                    </tr>
                @endforeach
            </tbody>
@endsection

@section('add-form')
    <form method="POST" action="{{ route('user.register') }}">
        @csrf

        <!-- Name -->
        <div>
            <label for="name">Name</label>
            <input type="text" id="name" name="name" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Agency -->
        <div>
            <label for="agency">Agency</label>
            <input type="text" id="agency" name="agency">
        </div>

        <!-- Email Address -->
        <div>
            <label for="email">Email</label>
            <input id="email" type="email" name="email" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Contact -->
        <div>
            <label for="contact">Contact</label>
            <input type="text" id="contact" name="contact">
        </div>

        <!-- Role 
            1 : Executive | 
            2 : Planning Director | 
            3 : Planning Officer | 
            4 : Agency Head | 
            5 : Agency Focal | 
            6 : User
        -->
        
        <div>
            <label for="role">Access Level</label>
            <select name="role" id="role">
                <option value="1">Executive</option>
                <option value="2">Planning Director</option>
                <option value="3">Planning Officer</option>
                <option value="4">Agency Head</option>
                <option value="5">Agency Focal</option>
                <option value="6">User</option>
            </select>
            @error('role')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label for="password">Password</label>

            <input type="password" id="password"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation">Confirm Password</label>
            <input id="password_confirmation"
                            type="password"
                            name="password_confirmation" 
                            required 
                            autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div>
            <input type="submit" value="Submit" class="submit-user">
        </div>
    </form>
@endsection