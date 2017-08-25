export default {
    sides: state => {
        let songs = state.songs;

        let sides = [];
        let track = 1;
        for (var i in songs) {
            let song_path = songs[i];

            let side = 'a';
            if (i > 6) {
                side = 'b';
                track = 1;
            }

            let song = {
                'path': song_path,
                'side': side,
                'track': track
            }

            sides.push(song);

            track++;
        }

        return sides;
    }
}