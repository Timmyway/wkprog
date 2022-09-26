<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workout program</title>
    <!-- FONTS -->
    <!-- <link href="https://fonts.googleapis.com/css2?family=Lato:wght@700;900&family=Open+Sans&display=swap" rel="stylesheet"> -->
	<link rel="stylesheet" href="style.css">   
</head>
<body>
	<div id="app" v-cloak>
		<button class="btn-menu" @click="showMenu = !showMenu" style="font-size: .7rem; margin-bottom: 3px;">Menu</button>
		<Transition name="fade">
			<div class="command-bar" v-show="showMenu">
				<div class="form-group">
					<select class="workout-select form-control " v-model="form.selectedWorkout">
						<template v-for="(wk,index) in wkList" :key="index">
						<option :value="wk">{{ wk }}</option>
						</template>
					</select>
				</div>

				<div class="form-group">
					<label for="form-workout-number">Number of training: </label>
					<input id="form-workout-number" type="number" 
						class="form-control input-workout-number"
						min="1" max="100" range="1"
						v-model="form.trainingNumber"
					>
				</div>
			</div>
		</Transition>

		<template v-for="workout in workouts" :key="workout.id">
		<Transition name="fade">
		<div class="workout" v-show="workout.name === form.selectedWorkout">
			<h4 class="workout__title">{{ workout.name }} ({{ workout.exercices?.length }} exercices)</h4>
			<h6 class="workout__subtitle"><span :style="{ marginRight: '150px' }">Période:</span> Durée: </h6>
			<template v-for="exercice in workout.exercices" :key="exercice.id">
			<div class="workout__exercice">				
				<table class="exercice-table">
					<tr>
						<th :style="{ width: '200px', position: 'relative' }">
							Name
							<span style="font-size: .8rem; position: absolute; left: 1px; top: 1px; text-transform: initial; font-style: italic;">N°{{ exercice.id }}</span>
						</th>
						<th :style="{ width: '240px' }">Progress</th>
						<th :style="{ width: '120px' }">Reps & sets</th>
						<th :style="{ width: '100px' }">Example</th>
						<th :style="{ width: '100px' }">Load</th>
						<th :style="{ width: '75px' }">Rest</th>						
						<th :style="{ width: 'auto' }" class="text-left">Description</th>						
					</tr>
					<tr>
						<td class="text-left">{{ exercice.name }}</td>
						<td class="text-left">
							<ul class="training-list">
								<template v-for="trainingIndex in form.trainingNumber" :key="trainingIndex">
								<li>S{{ trainingIndex }}: </li>
								</template>								
							</ul>
						</td>
						<td>{{ exercice.sets }} x {{ exercice.reps }}</td>
						<td>
							<img class="illustration" :src="`images/${exercice.illustration}`" alt="">
						</td>
						<td class="text-right"> Kg</td>
						<td>{{ exercice.rest }} secs</td>						
						<td class="text-left">{{ truncate(exercice.comments) }}</td>
					</tr>					
				</table>
			</div>
			</template>
		</div>
		</Transition>
		</template>
	</div>

	<!-- JS LIBRARIES -->
    <!-- Vue 3 -->
    <!-- <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>     -->
    <script src="vue.global.js"></script>

	<script>
		var workoutData = JSON.parse(`<?= file_get_contents('data.json') ?>`);
	</script>
	<script src="main.js"></script>
</body>
</html>