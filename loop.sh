#!/bin/bash

num=0

for f in *.wav
do
	arr+=($f)
done

 
while true; do
	if [ -z "$(pgrep "sox")" ]; then 
		sox "${arr[$num]}" -t wav - | sudo ./../../../home/pi/PiFmRds/src/pi_fm_rds -freq 93.5 -rt 'PI Radio' -audio -

		if ! [ "$[${#arr[@]}-1]" -eq "${num}" ]; then
			num=$[num+1]
		elif [ "$[${#arr[@]}-1]" -eq "${num}" ]; then
			num=0
		fi

	fi
done
